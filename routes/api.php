<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Disc\DiscController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('user')->group(function() {
    Route::post('/register', function(Request $request) {
        $rules = [
            'name' => 'unique:users|required',
            'email'    => 'unique:users|required',
            'password' => 'required',
        ];
    
        $input     = $request->only('name', 'email','password');
        $validator = Validator::make($input, $rules);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }
        
        $name     = $request->name;
        $email    = $request->email;
        $password = $request->password;
        $user     = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);

        return response()->json(['user'=> $user]);
    });
});

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $return = [
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'token' => $user->createToken($request->device_name)->plainTextToken
        ]
    ];

    return response($return);
});

Route::middleware('auth:sanctum')->get('/testauth', function() {
    return response(['message' => 'test ok']);
});

Route::middleware('auth:sanctum')->prefix('disc')->group(function () {
    Route::get('/testauth', function() {
        return response(['message' => 'test o 123k']);
    });
    Route::get('/list', [DiscController::class, 'show']);
});

Route::middleware('auth:sanctum')->get('/user', function () {
    return response(Auth::user());
});

Route::get('/', function() {
    return response(['message' => 'alive']);
});
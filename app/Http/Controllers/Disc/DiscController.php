<?php

namespace App\Http\Controllers\Disc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disc;

class DiscController extends Controller
{
    public function show()
    {
        $discs = Disc::all();

        return response(['discs' => $discs]);
    }
}

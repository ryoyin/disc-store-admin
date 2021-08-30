<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function all()
    {
        $categories = Category::all();
    
        return $categories;
    }

    public function getDiscs(Request $request)
    {
        $category = Category::where('slug', '=', $request->slug)->first();
        $discs = $category->discs;

        $discsInfo = [];
    
        foreach ($discs as $dIndex => $disc) {
            $category = $disc->category;
            $discFormat = $disc->discFormat;
            $studio = $disc->studio;
    
            $discsInfo[$dIndex] = $disc;
            $discsInfo[$dIndex]['coverImage'] = $disc->images->first();
            // $discsInfo[$dIndex]['category'] = $category->name;
            // $discsInfo[$dIndex]['discFormat'] = $discFormat->name;
            // $discsInfo[$dIndex]['studio'] = $studio->name;
        }
    
        return $discsInfo;
    }
}

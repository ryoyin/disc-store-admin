<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disc;

class DiscController extends Controller
{
    public function all()
    {
        $discs = Disc::all();

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

    public function detail(Request $request)
    {
        $disc = Disc::where('slug', '=', $request->slug)->first();
        $disc->category;
        $disc->discFormat;
        $disc->studio;
        $disc->images;

        $relatedDiscs = Disc::all();
        foreach ($relatedDiscs as $rIndex => $relatedDisc) {
            $relatedDiscs[$rIndex]['coverImage'] = $relatedDisc->images->first();
        }

        $data = [
            'detail' => $disc,
            'relatedDiscs' => $relatedDiscs
        ];

        return $data;
    }
}

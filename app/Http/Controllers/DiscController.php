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
}

<?php

namespace App\Http\Controllers;

use App\Models\SkinConcern;
use Illuminate\Http\Request;

class SkinConcernController extends Controller
{

    function skinConcernWiseProduct($slug=null)
    {
        $skinConcern = SkinConcern::where("slug",$slug)->first();
        return view("products.skin-concern-wise",compact("slug",'skinConcern'));
    }
}

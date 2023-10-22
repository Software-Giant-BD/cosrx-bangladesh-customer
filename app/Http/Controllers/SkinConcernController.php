<?php

namespace App\Http\Controllers;

use App\Models\SkinConcern;

class SkinConcernController extends Controller
{
    public function skinConcernWiseProduct($slug = null)
    {
        $skinConcern = SkinConcern::where('slug', $slug)->first();

        return view('products.skin-concern-wise', compact('slug', 'skinConcern'));
    }
}

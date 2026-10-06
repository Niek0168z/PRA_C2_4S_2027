<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;

class ManualController extends Controller
{
    public function show($brand_id, $brand_slug, $manual_id )
    {
        $brand = Brand::findOrFail($brand_id);
        $manual = Manual::findOrFail($manual_id);

        // Verhoog de counter
        $manual->increment('counter');

        // Top 5 manuals van dit merk
        $topManuals = Manual::where('brand_id', $brand_id)
            ->orderByDesc('counter')
            ->take(5)
            ->get();

        return view('pages/manual_view', [
            "manual" => $manual,
            "brand" => $brand,
            "topManuals" => $topManuals
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;

class DeleteController extends Controller
{
    public function show()
    {
        $manual = Manual::all();
        $brand = Brand::all();

        return view('pages/delete')->with('manuals', $manual)->with('brands', $brand);
    }

    public function delete()
    {
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Manual;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminManualController extends Controller
{
    public function create()
    {
        return view('pages.admin_manual_create', [
            'brands' => Brand::orderBy('name')->get(),
            'types' => Type::with('brand')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'type_id' => [
                'required',
                'integer',
                Rule::exists('types', 'id')->where('brand_id', $request->input('brand_id')),
            ],
            'name' => ['required', 'string', 'max:255'],
            'filesize' => ['required', 'integer', 'min:0'],
            'originUrl' => ['required', 'url'],
            'filename' => ['nullable', 'string', 'max:255'],
            'downloadedServer' => ['nullable', 'string', 'max:255'],
            'testcolumn' => ['nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($validated) {
            $manual = Manual::create([
                'brand_id' => $validated['brand_id'],
                'name' => $validated['name'],
                'filesize' => $validated['filesize'],
                'originUrl' => $validated['originUrl'],
                'filename' => $validated['filename'] ?? null,
                'downloadedServer' => $validated['downloadedServer'] ?? null,
                'counter' => 0,
                'testcolumn' => $validated['testcolumn'] ?? null,
            ]);

            $manual->types()->attach($validated['type_id']);
        });

        return redirect()->route('admin.manuals.create')->with('status', 'De handleiding is toegevoegd.');
    }
}

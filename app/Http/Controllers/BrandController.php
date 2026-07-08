<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::withCount('assets')
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%{$s}%"))
            ->latest()
            ->paginate(10);

        return view('master-data.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('master-data.brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'description' => 'nullable|string',
        ]);

        Brand::create($validated);
        return redirect()->route('brands.index')->with('success', 'Merek berhasil ditambahkan.');
    }

    public function edit(Brand $brand)
    {
        return view('master-data.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'description' => 'nullable|string',
        ]);

        $brand->update($validated);
        return redirect()->route('brands.index')->with('success', 'Merek berhasil diperbarui.');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->assets()->count() > 0) {
            return back()->with('error', 'Merek masih memiliki aset.');
        }
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Merek berhasil dihapus.');
    }
}

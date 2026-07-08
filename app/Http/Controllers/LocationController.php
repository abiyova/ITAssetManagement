<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $locations = Location::withCount('assets')
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%{$s}%"))
            ->latest()
            ->paginate(10);

        return view('master-data.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('master-data.locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:locations,name',
            'code' => 'required|string|max:10|unique:locations,code',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        Location::create($validated);
        return redirect()->route('locations.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function edit(Location $location)
    {
        return view('master-data.locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:locations,name,' . $location->id,
            'code' => 'required|string|max:10|unique:locations,code,' . $location->id,
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        $location->update($validated);
        return redirect()->route('locations.index')->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy(Location $location)
    {
        if ($location->assets()->count() > 0) {
            return back()->with('error', 'Lokasi masih memiliki aset.');
        }
        $location->delete();
        return redirect()->route('locations.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}

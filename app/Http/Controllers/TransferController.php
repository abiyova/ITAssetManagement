<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetTimeline;
use App\Models\AssetTransfer;
use App\Models\Department;
use App\Models\Location;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index(Request $request)
    {
        $transfers = AssetTransfer::with(['asset', 'fromLocation', 'toLocation', 'transferredBy'])
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate(15);

        return view('transfers.index', compact('transfers'));
    }

    public function create()
    {
        $assets = Asset::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();
        return view('transfers.create', compact('assets', 'locations', 'departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'from_location_id' => 'required|exists:locations,id',
            'to_location_id' => 'required|exists:locations,id|different:from_location_id',
            'from_department_id' => 'nullable|exists:departments,id',
            'to_department_id' => 'nullable|exists:departments,id',
            'transfer_date' => 'required|date',
            'reason' => 'nullable|string',
        ]);

        $transfer = AssetTransfer::create([
            ...$validated,
            'transferred_by' => auth()->id(),
            'status' => 'completed',
        ]);

        $asset = Asset::find($validated['asset_id']);
        $asset->update([
            'location_id' => $validated['to_location_id'],
            'department_id' => $validated['to_department_id'] ?? $asset->department_id,
        ]);

        $toLocation = Location::find($validated['to_location_id']);
        AssetTimeline::create([
            'asset_id' => $asset->id,
            'user_id' => auth()->id(),
            'action' => 'transferred',
            'description' => 'Aset dipindahkan ke ' . $toLocation->name,
        ]);

        return redirect()->route('transfers.index')->with('success', 'Perpindahan aset berhasil dicatat.');
    }

    public function edit(AssetTransfer $transfer)
    {
        $assets = Asset::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();
        return view('transfers.edit', compact('transfer', 'assets', 'locations', 'departments'));
    }

    public function update(Request $request, AssetTransfer $transfer)
    {
        $validated = $request->validate([
            'reason' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected,completed',
        ]);

        $transfer->update($validated);
        return redirect()->route('transfers.index')->with('success', 'Data perpindahan berhasil diperbarui.');
    }

    public function destroy(AssetTransfer $transfer)
    {
        $transfer->delete();
        return redirect()->route('transfers.index')->with('success', 'Data perpindahan berhasil dihapus.');
    }
}

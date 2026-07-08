<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetTimeline;
use App\Models\Maintenance;
use App\Models\User;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $maintenances = Maintenance::with(['asset', 'technician'])
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->when($request->type, fn ($q, $t) => $q->where('type', $t))
            ->latest()
            ->paginate(15);

        return view('maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        $assets = Asset::orderBy('name')->get();
        $technicians = User::orderBy('name')->get();
        return view('maintenances.create', compact('assets', 'technicians'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'technician_id' => 'nullable|exists:users,id',
            'type' => 'required|in:preventive,corrective',
            'schedule_date' => 'required|date',
            'cost' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $validated['status'] = 'scheduled';

        $maintenance = Maintenance::create($validated);

        $asset = Asset::find($validated['asset_id']);
        if ($asset->status !== 'maintenance') {
            $asset->update(['status' => 'maintenance']);
        }

        AssetTimeline::create([
            'asset_id' => $asset->id,
            'user_id' => auth()->id(),
            'action' => 'maintenance_scheduled',
            'description' => 'Maintenance dijadwalkan pada ' . $validated['schedule_date'],
        ]);

        return redirect()->route('maintenances.index')->with('success', 'Maintenance berhasil dijadwalkan.');
    }

    public function edit(Maintenance $maintenance)
    {
        $assets = Asset::orderBy('name')->get();
        $technicians = User::orderBy('name')->get();
        return view('maintenances.edit', compact('maintenance', 'assets', 'technicians'));
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'technician_id' => 'nullable|exists:users,id',
            'type' => 'required|in:preventive,corrective',
            'schedule_date' => 'required|date',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'cost' => 'nullable|numeric|min:0',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $maintenance->update($validated);

        if ($validated['status'] === 'completed') {
            $asset = Asset::find($maintenance->asset_id);
            $hasOtherMaintenance = Maintenance::where('asset_id', $asset->id)
                ->where('id', '!=', $maintenance->id)
                ->where('status', '!=', 'completed')
                ->exists();

            if (!$hasOtherMaintenance) {
                $asset->update(['status' => 'available']);
            }

            AssetTimeline::create([
                'asset_id' => $asset->id,
                'user_id' => auth()->id(),
                'action' => 'maintenance_completed',
                'description' => 'Maintenance selesai dengan biaya Rp ' . number_format($validated['cost'] ?? 0, 0, ',', '.'),
            ]);
        }

        return redirect()->route('maintenances.index')->with('success', 'Data maintenance berhasil diperbarui.');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenances.index')->with('success', 'Data maintenance berhasil dihapus.');
    }
}

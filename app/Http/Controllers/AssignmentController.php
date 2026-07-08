<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\AssetTimeline;
use App\Models\User;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        $assignments = AssetAssignment::with(['asset', 'assignedTo', 'assignedBy'])
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate(15);

        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        $assets = Asset::where('status', 'available')->orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('assignments.create', compact('assets', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'assigned_to' => 'required|exists:users,id',
            'assign_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $assignment = AssetAssignment::create([
            ...$validated,
            'assigned_by' => auth()->id(),
            'status' => 'active',
        ]);

        $asset = Asset::find($validated['asset_id']);
        $asset->update([
            'status' => 'assigned',
            'assigned_user_id' => $validated['assigned_to'],
        ]);

        $assignedUser = User::find($validated['assigned_to']);
        AssetTimeline::create([
            'asset_id' => $asset->id,
            'user_id' => auth()->id(),
            'action' => 'assigned',
            'description' => 'Aset dipinjamkan ke ' . $assignedUser->name,
        ]);

        return redirect()->route('assignments.index')->with('success', 'Peminjaman aset berhasil.');
    }

    public function edit(AssetAssignment $assignment)
    {
        $assets = Asset::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('assignments.edit', compact('assignment', 'assets', 'users'));
    }

    public function update(Request $request, AssetAssignment $assignment)
    {
        $validated = $request->validate([
            'assigned_to' => 'required|exists:users,id',
            'notes' => 'nullable|string',
        ]);

        $assignment->update($validated);
        return redirect()->route('assignments.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(AssetAssignment $assignment)
    {
        if ($assignment->status === 'active') {
            $asset = Asset::find($assignment->asset_id);
            $asset->update(['status' => 'available', 'assigned_user_id' => null]);

            AssetTimeline::create([
                'asset_id' => $asset->id,
                'user_id' => auth()->id(),
                'action' => 'returned',
                'description' => 'Aset dikembalikan dari peminjaman',
            ]);
        }

        $assignment->delete();
        return redirect()->route('assignments.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }

    public function return(AssetAssignment $assignment)
    {
        $assignment->update([
            'status' => 'returned',
            'return_date' => now(),
        ]);

        $asset = Asset::find($assignment->asset_id);
        $asset->update(['status' => 'available', 'assigned_user_id' => null]);

        AssetTimeline::create([
            'asset_id' => $asset->id,
            'user_id' => auth()->id(),
            'action' => 'returned',
            'description' => 'Aset berhasil dikembalikan oleh peminjam',
        ]);

        return redirect()->route('assignments.index')->with('success', 'Aset berhasil dikembalikan.');
    }
}

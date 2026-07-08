<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetTimeline;
use App\Models\Attachment;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Department;
use App\Models\Location;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        $assets = Asset::with(['category', 'brand', 'department', 'location'])
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%{$s}%")->orWhere('asset_code', 'like', "%{$s}%"))
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->when($request->category_id, fn ($q, $c) => $q->where('category_id', $c))
            ->latest()
            ->paginate(15);

        $categories = Category::orderBy('name')->get();

        return view('assets.index', compact('assets', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $vendors = Vendor::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();

        $lastAsset = Asset::latest('id')->first();
        $nextNumber = $lastAsset ? intval(substr($lastAsset->asset_code, -6)) + 1 : 1;
        $assetCode = 'AST-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

        return view('assets.create', compact('categories', 'brands', 'vendors', 'departments', 'locations', 'assetCode'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'vendor_id' => 'required|exists:vendors,id',
            'department_id' => 'required|exists:departments,id',
            'location_id' => 'required|exists:locations,id',
            'serial_number' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'purchase_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric|min:0',
            'warranty_end_date' => 'nullable|date|after_or_equal:purchase_date',
            'photo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $validated['asset_code'] = $request->asset_code;
        $validated['barcode'] = 'BC-' . $request->asset_code;
        $validated['qr_code'] = 'QR-' . $request->asset_code;
        $validated['status'] = 'draft';

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('assets', 'public');
        }

        $asset = Asset::create($validated);

        AssetTimeline::create([
            'asset_id' => $asset->id,
            'user_id' => auth()->id(),
            'action' => 'created',
            'description' => 'Aset berhasil dibuat di dalam sistem',
        ]);

        return redirect()->route('assets.index')->with('success', 'Aset berhasil ditambahkan.');
    }

    public function show(Asset $asset)
    {
        $asset->load(['category', 'brand', 'vendor', 'department', 'location', 'assignedUser']);
        return view('assets.show', compact('asset'));
    }

    public function edit(Asset $asset)
    {
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $vendors = Vendor::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();

        return view('assets.edit', compact('asset', 'categories', 'brands', 'vendors', 'departments', 'locations'));
    }

    public function update(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'vendor_id' => 'required|exists:vendors,id',
            'department_id' => 'required|exists:departments,id',
            'location_id' => 'required|exists:locations,id',
            'serial_number' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'purchase_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric|min:0',
            'warranty_end_date' => 'nullable|date',
            'photo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,available,assigned,maintenance,damaged,lost,retired,disposed',
        ]);

        $oldValues = $asset->only(array_keys($validated));

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('assets', 'public');
        }

        $asset->update($validated);

        AssetTimeline::create([
            'asset_id' => $asset->id,
            'user_id' => auth()->id(),
            'action' => 'updated',
            'description' => 'Data aset berhasil diperbarui',
            'old_values' => $oldValues,
            'new_values' => $asset->only(array_keys($validated)),
        ]);

        return redirect()->route('assets.index')->with('success', 'Aset berhasil diperbarui.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Aset berhasil dihapus.');
    }

    public function timeline(Asset $asset)
    {
        $asset->load('timelines.user');
        return view('assets.timeline', compact('asset'));
    }

    public function attachments(Asset $asset)
    {
        $asset->load('attachments');
        return view('assets.attachments', compact('asset'));
    }

    public function storeAttachment(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:invoice,purchase_order,warranty_card,manual_book,photo',
            'file' => 'required|file|max:10240',
        ]);

        $file = $request->file('file');
        $path = $file->store('attachments/' . $asset->asset_code, 'public');

        $asset->attachments()->create([
            'type' => $validated['type'],
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return back()->with('success', 'Lampiran berhasil ditambahkan.');
    }

    public function deleteAttachment(Asset $asset, Attachment $attachment)
    {
        $attachment->delete();
        return back()->with('success', 'Lampiran berhasil dihapus.');
    }

    public function print(Asset $asset)
    {
        return view('assets.print', compact('asset'));
    }
}

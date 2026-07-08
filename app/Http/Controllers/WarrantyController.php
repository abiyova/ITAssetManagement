<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'active');

        $query = Asset::with(['category', 'brand', 'department']);

        if ($filter === 'active') {
            $query->where('warranty_end_date', '>=', now());
        } elseif ($filter === 'expiring') {
            $query->where('warranty_end_date', '>=', now())
                ->where('warranty_end_date', '<=', now()->addDays(30));
        } elseif ($filter === 'expired') {
            $query->where('warranty_end_date', '<', now());
        }

        $assets = $query->orderBy('warranty_end_date')->paginate(15);

        $counts = [
            'active' => Asset::where('warranty_end_date', '>=', now())->count(),
            'expiring' => Asset::where('warranty_end_date', '>=', now())
                ->where('warranty_end_date', '<=', now()->addDays(30))
                ->count(),
            'expired' => Asset::where('warranty_end_date', '<', now())->count(),
        ];

        return view('warranty.index', compact('assets', 'filter', 'counts'));
    }
}

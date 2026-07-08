<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\AssetTransfer;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', date('Y'));

        $totalAssets = Asset::count();
        $availableAssets = Asset::where('status', 'available')->count();
        $assignedAssets = Asset::where('status', 'assigned')->count();
        $maintenanceAssets = Asset::where('status', 'maintenance')->count();
        $damagedAssets = Asset::where('status', 'damaged')->count();
        $lostAssets = Asset::where('status', 'lost')->count();
        $retiredAssets = Asset::where('status', 'retired')->count();
        $disposedAssets = Asset::where('status', 'disposed')->count();
        $warrantyExpired = Asset::where('warranty_end_date', '<', now())->count();
        $totalValue = Asset::sum('purchase_price');

        $assetsByCategory = Asset::select('categories.name', DB::raw('count(*) as total'))
            ->join('categories', 'assets.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->pluck('total', 'name');

        $assetsByDepartment = Asset::select('departments.name', DB::raw('count(*) as total'))
            ->join('departments', 'assets.department_id', '=', 'departments.id')
            ->groupBy('departments.name')
            ->pluck('total', 'name');

        $assetsByLocation = Asset::select('locations.name', DB::raw('count(*) as total'))
            ->join('locations', 'assets.location_id', '=', 'locations.id')
            ->groupBy('locations.name')
            ->pluck('total', 'name');

        $assetsByStatus = Asset::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $monthlyPurchases = Asset::select(DB::raw('MONTH(purchase_date) as month'), DB::raw('count(*) as total'))
            ->whereYear('purchase_date', $year)
            ->groupBy(DB::raw('MONTH(purchase_date)'))
            ->pluck('total', 'month');

        $maintenanceByMonth = Maintenance::select(DB::raw('MONTH(schedule_date) as month'), DB::raw('count(*) as total'))
            ->whereYear('schedule_date', $year)
            ->groupBy(DB::raw('MONTH(schedule_date)'))
            ->pluck('total', 'month');

        $warrantyStatus = [
            'active' => Asset::where('warranty_end_date', '>=', now())->count(),
            'expiring' => Asset::where('warranty_end_date', '>=', now())
                ->where('warranty_end_date', '<=', now()->addDays(30))
                ->count(),
            'expired' => Asset::where('warranty_end_date', '<', now())->count(),
        ];

        $recentActivities = Asset::with(['category', 'assignedUser'])
            ->latest()
            ->take(10)
            ->get();

        $upcomingWarranty = Asset::where('warranty_end_date', '>=', now())
            ->where('warranty_end_date', '<=', now()->addDays(30))
            ->orderBy('warranty_end_date')
            ->take(5)
            ->get();

        $upcomingMaintenance = Maintenance::with(['asset', 'technician'])
            ->where('schedule_date', '>=', now())
            ->orderBy('schedule_date')
            ->take(5)
            ->get();

        $recentAssigned = AssetAssignment::with(['asset', 'assignedTo'])
            ->where('status', 'active')
            ->latest()
            ->take(5)
            ->get();

        $recentTransfers = AssetTransfer::with(['asset', 'fromLocation', 'toLocation'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalAssets', 'availableAssets', 'assignedAssets', 'maintenanceAssets',
            'damagedAssets', 'lostAssets', 'retiredAssets', 'disposedAssets',
            'warrantyExpired', 'totalValue', 'assetsByCategory', 'assetsByDepartment',
            'assetsByLocation', 'assetsByStatus', 'monthlyPurchases', 'maintenanceByMonth',
            'warrantyStatus', 'recentActivities', 'upcomingWarranty', 'upcomingMaintenance',
            'recentAssigned', 'recentTransfers', 'year'
        ));
    }
}

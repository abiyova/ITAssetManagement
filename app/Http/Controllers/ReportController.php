<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\AssetTransfer;
use App\Models\Maintenance;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AssetExport;
use App\Exports\AssignmentExport;
use App\Exports\TransferExport;
use App\Exports\MaintenanceExport;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function assetReport(Request $request)
    {
        $assets = Asset::with(['category', 'brand', 'department', 'location'])
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->when($request->category_id, fn ($q, $c) => $q->where('category_id', $c))
            ->get();

        $totalValue = $assets->sum('purchase_price');

        return view('reports.asset', compact('assets', 'totalValue'));
    }

    public function assignmentReport(Request $request)
    {
        $assignments = AssetAssignment::with(['asset', 'assignedTo', 'assignedBy'])
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->get();

        return view('reports.assignment', compact('assignments'));
    }

    public function transferReport(Request $request)
    {
        $transfers = AssetTransfer::with(['asset', 'fromLocation', 'toLocation', 'transferredBy'])
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->get();

        return view('reports.transfer', compact('transfers'));
    }

    public function maintenanceReport(Request $request)
    {
        $maintenances = Maintenance::with(['asset', 'technician'])
            ->when($request->type, fn ($q, $t) => $q->where('type', $t))
            ->get();

        $totalCost = $maintenances->sum('cost');

        return view('reports.maintenance', compact('maintenances', 'totalCost'));
    }

    public function warrantyReport(Request $request)
    {
        $assets = Asset::with(['category', 'brand', 'department'])
            ->whereNotNull('warranty_end_date')
            ->orderBy('warranty_end_date')
            ->get();

        return view('reports.warranty', compact('assets'));
    }

    public function exportPdf($type)
    {
        $data = $this->getReportData($type);
        $pdf = Pdf::loadView("reports.pdf.{$type}", $data);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download("laporan-{$type}-" . now()->format('Y-m-d') . ".pdf");
    }

    public function exportExcel($type)
    {
        return Excel::download(new AssetExport, "laporan-{$type}-" . now()->format('Y-m-d') . ".xlsx");
    }

    private function getReportData($type)
    {
        return match ($type) {
            'asset' => ['assets' => Asset::with(['category', 'brand', 'department', 'location'])->get()],
            'assignment' => ['assignments' => AssetAssignment::with(['asset', 'assignedTo'])->get()],
            'transfer' => ['transfers' => AssetTransfer::with(['asset', 'fromLocation', 'toLocation'])->get()],
            'maintenance' => ['maintenances' => Maintenance::with(['asset', 'technician'])->get()],
            'warranty' => ['assets' => Asset::with(['category', 'brand'])->whereNotNull('warranty_end_date')->get()],
            default => [],
        };
    }
}

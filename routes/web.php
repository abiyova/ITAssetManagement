<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WarrantyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('brands', BrandController::class)->except(['show']);
    Route::resource('vendors', VendorController::class)->except(['show']);
    Route::resource('departments', DepartmentController::class)->except(['show']);
    Route::resource('locations', LocationController::class)->except(['show']);
    Route::resource('employees', EmployeeController::class)->except(['show']);
    Route::resource('assets', AssetController::class);
    Route::resource('assignments', AssignmentController::class)->except(['show']);
    Route::post('/assignments/{assignment}/return', [AssignmentController::class, 'return'])->name('assignments.return');
    Route::resource('transfers', TransferController::class)->except(['show']);
    Route::resource('maintenances', MaintenanceController::class)->except(['show']);

    Route::get('/warranty', [WarrantyController::class, 'index'])->name('warranty.index');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/asset', [ReportController::class, 'assetReport'])->name('reports.asset');
    Route::get('/reports/assignment', [ReportController::class, 'assignmentReport'])->name('reports.assignment');
    Route::get('/reports/transfer', [ReportController::class, 'transferReport'])->name('reports.transfer');
    Route::get('/reports/maintenance', [ReportController::class, 'maintenanceReport'])->name('reports.maintenance');
    Route::get('/reports/warranty', [ReportController::class, 'warrantyReport'])->name('reports.warranty');
    Route::get('/reports/{type}/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.export-pdf');
    Route::get('/reports/{type}/export-excel', [ReportController::class, 'exportExcel'])->name('reports.export-excel');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');

    Route::get('/assets/{asset}/timeline', [AssetController::class, 'timeline'])->name('assets.timeline');
    Route::get('/assets/{asset}/attachments', [AssetController::class, 'attachments'])->name('assets.attachments');
    Route::post('/assets/{asset}/attachments', [AssetController::class, 'storeAttachment'])->name('assets.store-attachment');
    Route::delete('/assets/{asset}/attachments/{attachment}', [AssetController::class, 'deleteAttachment'])->name('assets.delete-attachment');
    Route::get('/assets/{asset}/print', [AssetController::class, 'print'])->name('assets.print');
});

require __DIR__.'/auth.php';

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'asset_code', 'name', 'category_id', 'brand_id', 'vendor_id',
        'department_id', 'location_id', 'assigned_user_id', 'serial_number',
        'model', 'purchase_date', 'purchase_price', 'warranty_end_date',
        'photo', 'description', 'barcode', 'qr_code', 'status',
    ];

    protected function casts(): array
    {
        return [
            'purchase_date' => 'date',
            'purchase_price' => 'decimal:2',
            'warranty_end_date' => 'date',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function assignments()
    {
        return $this->hasMany(AssetAssignment::class);
    }

    public function transfers()
    {
        return $this->hasMany(AssetTransfer::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function timelines()
    {
        return $this->hasMany(AssetTimeline::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeAssigned($query)
    {
        return $query->where('status', 'assigned');
    }

    public function scopeMaintenance($query)
    {
        return $query->where('status', 'maintenance');
    }

    public function scopeWarrantyActive($query)
    {
        return $query->where('warranty_end_date', '>=', now());
    }

    public function scopeWarrantyExpiring($query, $days = 30)
    {
        return $query->where('warranty_end_date', '>=', now())
            ->where('warranty_end_date', '<=', now()->addDays($days));
    }

    public function scopeWarrantyExpired($query)
    {
        return $query->where('warranty_end_date', '<', now());
    }

    public function isWarrantyActive(): bool
    {
        return $this->warranty_end_date && $this->warranty_end_date->isFuture();
    }

    public function isWarrantyExpiring(int $days = 30): bool
    {
        return $this->warranty_end_date
            && $this->warranty_end_date->isFuture()
            && $this->warranty_end_date->lte(now()->addDays($days));
    }
}

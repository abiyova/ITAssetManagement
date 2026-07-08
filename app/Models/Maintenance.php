<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id', 'technician_id', 'type', 'schedule_date',
        'start_date', 'end_date', 'cost', 'status', 'notes', 'attachment',
    ];

    protected function casts(): array
    {
        return [
            'schedule_date' => 'date',
            'start_date' => 'date',
            'end_date' => 'date',
            'cost' => 'decimal:2',
        ];
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}

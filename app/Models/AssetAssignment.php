<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['asset_id', 'assigned_to', 'assigned_by', 'assign_date', 'return_date', 'notes', 'status'];

    protected function casts(): array
    {
        return [
            'assign_date' => 'date',
            'return_date' => 'date',
        ];
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}

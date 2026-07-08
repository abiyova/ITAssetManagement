<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'contact_person', 'email', 'phone', 'address', 'description'];

    protected static function booted(): void
    {
        static::creating(function (Vendor $vendor) {
            $vendor->slug = Str::slug($vendor->name);
        });

        static::updating(function (Vendor $vendor) {
            $vendor->slug = Str::slug($vendor->name);
        });
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}

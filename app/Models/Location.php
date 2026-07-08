<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'code', 'address', 'city', 'province', 'description'];

    protected static function booted(): void
    {
        static::creating(function (Location $location) {
            $location->slug = Str::slug($location->name);
        });

        static::updating(function (Location $location) {
            $location->slug = Str::slug($location->name);
        });
    }

    public function assets()
    {
        return $this->hasMany(Asset::class, 'location_id');
    }
}

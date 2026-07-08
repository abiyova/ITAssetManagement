<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'description'];

    protected static function booted(): void
    {
        static::creating(function (Brand $brand) {
            $brand->slug = Str::slug($brand->name);
        });

        static::updating(function (Brand $brand) {
            $brand->slug = Str::slug($brand->name);
        });
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}

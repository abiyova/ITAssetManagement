<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'code', 'description'];

    protected static function booted(): void
    {
        static::creating(function (Department $department) {
            $department->slug = Str::slug($department->name);
        });

        static::updating(function (Department $department) {
            $department->slug = Str::slug($department->name);
        });
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}

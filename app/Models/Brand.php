<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'banner',
    ];

    protected $appends = ['logo_url', 'banner_url'];

    protected $hidden = ['deleted_at'];

    public function outlets()
    {
        return $this->hasMany(Outlet::class, 'brand_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }

    public function getLogoUrlAttribute()
    {
        return url(Storage::url('brands/' . $this->logo));
    }

    public function getBannerUrlAttribute()
    {
        return url(Storage::url('brands/' . $this->banner));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Outlet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'picture',
        'address',
        'longitude',
        'latitude',
        'brand_id'
    ];

    protected $appends = ['picture_url'];
    protected $hidden = ['deleted_at'];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function getPictureUrlAttribute()
    {
        return url(Storage::url('outlets/' . $this->picture));
    }
}

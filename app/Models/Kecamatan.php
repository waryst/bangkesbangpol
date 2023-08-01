<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory,HasUuids;
    protected $guarded=['id'];
    
    public function desa()
    {
        return $this->hasMany(Desa::class);
    }

    public function tps()
    {
        return $this->hasManyThrough(Tps::class, Desa::class);
    }

    public function scopeTabel($query)
    {
        return $query->withCount('desa')->orderBy('created_at', 'DESC')->get();
    }
    public function dapil()
    {
        return $this->belongsTo(Dapil::class);
    }
}

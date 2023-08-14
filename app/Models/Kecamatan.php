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
    public function dapil()
    {
        return $this->belongsTo(Dapil::class);
    }

    public function scopeJumlahDalamDapil($query, $dapil_id)
    {
        return $query->where('dapil_id', $dapil_id)->count();
    }
}

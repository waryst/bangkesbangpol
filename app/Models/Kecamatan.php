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

    public function suaracapres()
    {
        return $this->hasMany(Suaracapres::class);
    }
    public function suaracagub()
    {
        return $this->hasMany(Suaracagub::class);
    }
    public function suaracabub()
    {
        return $this->hasMany(Suaracabub::class);
    }
    public function suaradpd()
    {
        return $this->hasMany(Suaradpd::class);
    }
    public function suaracaleg()
    {
        return $this->hasMany(Suaracaleg::class);
    }
    public function suaracalegprov()
    {
        return $this->hasMany(Suaracalegprov::class);
    }
    public function suaracalegkab()
    {
        return $this->hasMany(Suaracalegkab::class);
    }
}

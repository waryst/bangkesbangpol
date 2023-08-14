<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory,HasUuids;
    protected $guarded=['id'];
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
    public function tps()
    {
        return $this->hasMany(Tps::class);
    }

    public function suaracapres(){
        return $this->hasMany(Suaracapres::class);
    }
    public function suaracagub(){
        return $this->hasMany(Suaracagub::class);
    }
    public function suaracabub(){
        return $this->hasMany(Suaracabub::class);
    }
    public function suaradpd(){
        return $this->hasMany(Suaradpd::class);
    }
    public function scopeJumlahDesa($query, $kecamatan_id)
    {
        return $query->where('kecamatan_id', $kecamatan_id)->count();
    }

    public function scopeTabel($query, $kecamatan_id)
    {
        return $query->where('kecamatan_id', $kecamatan_id)->withCount('tps')->orderBy('created_at', 'DESC')->get();
    }
}

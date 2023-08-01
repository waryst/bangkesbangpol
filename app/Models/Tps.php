<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory,HasUuids;
    protected $guarded=['id'];

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function scopeTerakhir($query, $id)
    {
        $data = $query->where('desa_id', $id)->orderBy('id', 'DESC')->first();
        if ($data) {
            return $data->title;
        }
        return "0";
    }

    public function scopeJumlahTps($query, $desa_id)
    {
        return $query->where('desa_id', $desa_id)->count();
    }

    public function scopeTabel($query, $desa_id)
    {
        return $query->where('desa_id', $desa_id)->orderBy('id', 'DESC')->get();
    }

    public function scopeDeleteAll($query, $desa_id)
    {
        return $query->where('desa_id', $desa_id)->delete();
    }

    public function suaracapres()
    {
        return $this->hasMany(Suaracapres::class);
    }
}

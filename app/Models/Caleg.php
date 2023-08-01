<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caleg extends Model
{
    use HasFactory,HasUuids;
    protected $guarded=['id'];
    public function dapil(){
        return $this->belongsTo(Dapil::class);
    }
    public function partai(){
        return $this->belongsTo(Partai::class);
    }
    public function suaracaleg(){
        return $this->hasMany(Suaracaleg::class);
    }
    public function suaracalegprov(){
        return $this->hasMany(Suaracalegprov::class);
    }
}

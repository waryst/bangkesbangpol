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

    public function suaracapres()
    {
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
    public function suaracaleg(){
        return $this->hasMany(Suaracaleg::class);
    }
}

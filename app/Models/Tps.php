<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory,HasUuids;
    protected $guarded=['id'];
    public function desa(){
        return $this->belongsTo(Desa::class);
    }
    public function suaracapres(){
        return $this->hasMany(Suaracapres::class);
    }
}

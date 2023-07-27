<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partai extends Model
{
    use HasFactory,HasUuids;
    protected $guarded=['id'];
    public function caleg(){
        return $this->hasMany(Caleg::class);
    }
    public function suaracaleg(){
        return $this->hasManyThrough(Suaracaleg::class,Caleg::class);
    }
}

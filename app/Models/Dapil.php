<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dapil extends Model
{
    use HasFactory,HasUuids;
    protected $guarded=['id'];
    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class);
    }
    public function caleg()
    {
        return $this->hasMany(Caleg::class);
    }
    public function desa()
    {
        return $this->hasManyThrough(Desa::class,Kecamatan::class);
    }
}

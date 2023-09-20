<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partai extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];
    public function caleg()
    {
        return $this->hasMany(Caleg::class);
    }

    public function suarapartai()
    {
        return $this->hasMany(Suarapartairi::class);
    }
    public function suarapartaiprov()
    {
        return $this->hasMany(suarapartaiprov::class);
    }
    public function suarapartaikab()
    {
        return $this->hasMany(Suarapartaikab::class);
    }
    // public function suarapartai(){
    //     return $this->hasMany(Suaracaleg::class);
    // }
    // public function suarapartaiprov()
    // {
    //     return $this->hasMany(Suaracalegprov::class);
    // }
    // public function suarapartaikab()
    // {
    //     return $this->hasMany(Suaracalegkab::class);
    // }
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cagub extends Model
{
    use HasFactory,HasUuids;
    protected $guarded=['id'];
    public function suaracagub(){
        return $this->hasMany(Suaracagub::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suaracapres extends Model
{
    use HasFactory,HasUuids;
    protected $guarded=['id'];
    public function capres(){
        return $this->belongsTo(Capres::class);
    }
}

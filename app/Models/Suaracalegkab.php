<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suaracalegkab extends Model
{
    use HasFactory,HasUuids;
    protected $guarded=['id'];
    public function caleg(){
        return $this->belongsTo(Caleg::class);
    }
    public function tps(){
        return $this->belongsTo(Tps::class);
    }
}

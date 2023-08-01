<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suaradpd extends Model
{
    use HasFactory,HasUuids;
    protected $guarded=['id'];
    public function dpd(){
        return $this->belongsTo(Dpd::class);
    }
    public function tps(){
        return $this->belongsTo(Tps::class);
    }
}

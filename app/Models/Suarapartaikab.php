<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suarapartaikab extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];
    public function tps()
    {
        return $this->belongsTo(Tps::class);
    }
}

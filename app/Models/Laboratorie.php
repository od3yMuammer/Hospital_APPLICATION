<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laboratorie extends Model
{
    use HasFactory;
    protected $guarded=[];
    use SoftDeletes;

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}


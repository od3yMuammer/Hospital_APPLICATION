<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Major extends Model
{

    use HasFactory;
    protected $guarded=[];
    use SoftDeletes;

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'doctor_id');
    }
}

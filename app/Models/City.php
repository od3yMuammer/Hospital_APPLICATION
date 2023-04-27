<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    use HasFactory;
    public function ambulances()
    {
        return $this->hasMany(Ambulance::class, 'ambulance_id');
    }
    public function hospitals()
    {
        return $this->hasMany(Hospital::class, 'hospital_id');
    }
    public function laboratories()
    {
        return $this->hasMany(Laboratorie::class, 'laboratories_id');
    }
    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'doctor_id');
    }
}

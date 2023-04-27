<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    protected $guarded=[];
    use SoftDeletes;

    public function categore()
    {
        return $this->belongsTo(Categore::class);
    }

}

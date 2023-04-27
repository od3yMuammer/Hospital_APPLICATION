<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categore extends Model
{
    protected $table="categories";
    use HasFactory;
    protected $guarded=[];
    use SoftDeletes;

    public function articles()
    {
        return $this->hasMany(Article::class, 'article_id');
    }

}

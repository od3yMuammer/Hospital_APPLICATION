<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
//    protected $table = 'messages';
    protected $fillable = [
        'id','message_text','sender_name','sender_email','sender_phone','ip'
    ];
}

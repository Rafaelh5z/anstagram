<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_sent',
        'user_recive',
    ];

    public function usersent(){
        return $this->belongsTo(User::class,'user_sent');
    }

    public function userrecive(){
        return $this->belongsTo(User::class,'user_recive');
    }

    public function messages(){
        return $this->hasMany(Messages::class,'chat_id');
    }
}

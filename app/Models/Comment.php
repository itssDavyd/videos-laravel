<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    //Relacion de Many to One (Muchos a 1).
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}

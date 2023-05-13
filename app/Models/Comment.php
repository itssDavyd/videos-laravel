<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    //Relacion de Many to One (Muchos a 1).
    /**
     * @var mixed
     */
    private $user_id;
    /**
     * @var mixed
     */
    private $video_id;
    /**
     * @var mixed
     */
    private $body;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}

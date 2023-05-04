<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos';

    //Relacion One To Many (1 a muchos), dentro de un video puede haber muchos comentarios.
    /**
     * @var mixed
     */
    private $description;
    /**
     * @var mixed
     */
    private $title;
    /**
     * @var mixed
     */
    private $user_id;
    /**
     * @var mixed|string
     */
    private $image;
    /**
     * @var mixed|string
     */
    private $video_path;

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    //Relacion de Many to One (Muchos a 1).
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }


}

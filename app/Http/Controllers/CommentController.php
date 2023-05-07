<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'body' => 'required'
        ]);
        $comment = new Comment();

        //Obtenemos la autentificacion del usuario de la sesion.
        $user = Auth::user();
        $comment->user_id = $user->id;
        $comment->video_id = $request->input('video_id');
        $comment->body = $request->input('body');

        $comment->save();

        return redirect()->route('detailVideo', ['video_id' => $comment->video_id])->with(['msg' => 'Comentario añadido correctamente !!']);
    }

}

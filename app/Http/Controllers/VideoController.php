<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Video;
use App\Models\Comment;


class VideoController extends Controller
{
    public function createVideo()
    {
        return view('video.createVideo');
    }

    public function saveVideo(Request $request)
    {
        //Validar form.
        $validate = $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required',
            'video' => 'mimes:mp4',
        ]);

        $video = new Video();
        $user = Auth::user();
        $video->user_id = $user->id;
        $video->title = $request->input('title');
        $video->description = $request->input('description');

        $video->save();

        return redirect()->route('home')->with(['message' => 'El video se subio correctamente']);
    }
}

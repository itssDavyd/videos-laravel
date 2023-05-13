<?php

namespace App\Http\Controllers;

use Faker\Core\File;
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

        //Subida de la imagen (miniatura)
        //Para que acabe de funcionar y laravel sepa donde llevarte de ruta tienes que configurar en config/filesystems.php la ruta que usa para las miniaturas (images) y para los videos posteriormente. (DEFAULT siempre entra a app/public).
        $image = $request->file('image');
        if ($image) {
            $image_path = time() . '_' . $image->getClientOriginalName();
            Storage::disk('images')->put($image_path, $image->getContent());
            $video->image = $image_path;
        }

        //Subida del video.
        $video_file = $request->file('video');
        if ($video_file) {
            $video_path = time() . '_' . $video_file->getClientOriginalName();
            Storage::disk('videos')->put($video_path, $video_file->getContent());
            $video->video_path = $video_path;
        }


        $video->save();

        return redirect()->route('home')->with(['message' => 'El video se subio correctamente']);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return \response($file, 200);
    }

    public function getVideoPage($video_id)
    {
        //saca un unico registro del video id.
        $video = Video::find($video_id);

        return view('video.detail', ['video' => $video]);


    }

    public function getVideo($filename)
    {
        $file = Storage::disk('videos')->get($filename);
        return \response($file, 200);
    }

    public function delete($video_id)
    {
        $user = Auth::user();
        $video = DB::table('videos')->find($video_id);

        if ($user && $video->user_id == $user->getAuthIdentifier()) {

            !is_null($video->image) && Storage::disk('images')->delete($video->image);
            !is_null($video->video_path) && Storage::disk('videos')->delete($video->video_path);

            DB::table('videos')->delete($video_id);
            $message = 'Video borrado correctamente !!';

        } else {
            $message = 'El video no se ha podido eliminar correctamente !!';
        }
        return redirect()->route('home')->with(['message' => $message]);
    }
}

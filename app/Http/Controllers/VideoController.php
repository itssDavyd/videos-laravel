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
    const TIPO_FILTER_MAS_NUEVO = 'new';
    const TIPO_FILTER_MAS_VIEJO = 'old';
    const TIPO_FILTER_ALPHA = 'alpha';

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

    public function edit($video_id)
    {
        $user = Auth::user();
        $video = Video::findOrFail($video_id);
        if ($user && $video->user_id == $user->getAuthIdentifier()) {
            return view('video.edit', ['video' => $video]);
        } else {
            return redirect()->route('home');
        }
    }

    public function update($video_id, Request $request)
    {

        $validate = $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required',
            'video' => 'mimes:mp4',
        ]);

        $video = Video::findOrFail($video_id);
        $user = Auth::user();

        $video->user_id = $user->getAuthIdentifier();
        $video->title = $request->input('title');
        $video->description = $request->input('description');

        $image = $request->file('image');
        if ($image) {

            //Comprueba si el video a tratar tiene imagen, si es asi, borra su imagen actual para insertar la nueva.
            if ($video->image) {
                Storage::disk('images')->delete($video->image);
            }

            $image_path = time() . '_' . $image->getClientOriginalName();
            Storage::disk('images')->put($image_path, $image->getContent());
            $video->image = $image_path;
        }

        $video_file = $request->file('video');
        if ($video_file) {

            //Comprueba si el video a tratar tiene video, si es asi, borra su video actual para insertar el nuevo.
            if ($video->video_path) {
                Storage::disk('videos')->delete($video->video_path);
            }

            $video_path = time() . '_' . $video_file->getClientOriginalName();
            Storage::disk('videos')->put($video_path, $video_file->getContent());


            $video->video_path = $video_path;
        }

        //Update en la BDD con la tabla VIDEO.
        $video->update();

        return redirect()->route('home')->with(['message' => 'El video se ha actualizado correctamente !!']);

    }

    public function search(Request $request)
    {
        $search = $request->input('searchVideo');

        //Para el buscador, funcionamiento, llega como search y le hacemos un like, principalmente se usa para el title pero podriamos implementarlo para cualquier campo de la table en BDD.
        if (!empty($search)) {
            $result = Video::where('title', 'LIKE', '%' . $search . '%')->paginate(5);
            return view('video.search', ['videos' => $result, 'search' => $search]);
        } else {
            return redirect()->route('home')->with(['message' => 'Debe introducir algun dato para realizar una busqueda.']);
        }
    }

    public function filter(Request $request, $buscadorActivo = null)
    {
        $filter = $request->input('filter');

        if (!empty($filter) && $buscadorActivo != null) {
            $result = null;
            switch ($filter) {
                case self::TIPO_FILTER_MAS_NUEVO:
                    $result = Video::where('title', 'LIKE', '%' . $buscadorActivo . '%')->orderBy('id', 'desc')->paginate(5);
                    break;
                case self::TIPO_FILTER_MAS_VIEJO:
                    $result = Video::where('title', 'LIKE', '%' . $buscadorActivo . '%')->orderBy('id', 'asc')->paginate(5);
                    break;
                case self::TIPO_FILTER_ALPHA:
                    $result = Video::where('title', 'LIKE', '%' . $buscadorActivo . '%')->orderBy('title', 'asc')->paginate(5);
                    break;
            }
            return view('video.search', ['videos' => $result, 'search' => $buscadorActivo, 'filter' => $filter]);
        } else {
            return redirect()->route('home')->with(['message' => 'Debe introducir algun filtro para realizar la busqueda.']);
        }
    }
}

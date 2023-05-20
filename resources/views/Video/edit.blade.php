@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{route('updateVideo',['video_id'=>$video->id])}}" method="POST" enctype="multipart/form-data"
                  class="col-lg-7">
                @csrf

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $err)
                                <li>{{$err}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2>{{$video->title}}</h2>
                <hr>
                <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$video->title}}">
                </div>
                <div class="form-group">
                    <label for="description">Descripcion</label>
                    <textarea class="form-control" id="description" name="description"
                              value="{{$video->description}}"></textarea>
                </div>
                <div class="form-group">
                    <img class="video_image" src="{{url('/miniatura/'.$video->image)}}"
                         alt="miniatura"><br>
                    <label for="image">Miniatura</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="form-group">
                    <div class="video_controller"
                         style="display: flex; align-items: center; justify-content: center; padding: 1rem; border: 1px solid black; margin: 1rem;">
                        <video height="240" controls>
                            <source src="{{route('videoFile',['filename'=>$video->video_path])}}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <label for="video">Archivo de video</label>
                    <input type="file" class="form-control" id="video" name="video">
                </div>
                <br>
                <button type="submit" class="btn btn-success">Guardar video</button>
                <a href="{{url()->previous()}}" class="m-lg-1 btn btn-primary">Volver</a>
            </form>
        </div>
    </div>

@endsection

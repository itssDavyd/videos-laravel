@extends('layouts.app')
@section('content')
    @if(session('msg'))
        <div class="alert alert-success">
            {{session('msg')}}
        </div>
    @endif
    <div class="container-submain" style="display: flex;justify-content: center; gap: 3rem;">
        <div class="card" style="width: 30rem;">
            <img class="video_image" src="{{url('/miniatura/'.$video->image)}}"
                 alt="miniatura">
            @if(!empty($video->video_path))
                <hr>
                <h3 style="text-align: center;font-style:italic">Zona video:</h3>
                <hr>
                <div class="video_controller"
                     style="display: flex; align-items: center; justify-content: center; padding: 1rem; border: 1px solid black; margin: 1rem;">
                    <video height="240" controls>
                        <source src="{{route('videoFile',['filename'=>$video->video_path])}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endif
            <div class="card-header">
                {{$video->title}}
            </div>
            <div class="card-body">

                <p class="card-text">
                    {{$video->description}}
                </p>

                <p class="card-text"><small
                        class="text-muted">{{$video->user->name.' '.$video->user->surname}}
                        - {{$video->created_at}}</small></p>
            </div>
            <div class="card-footer">
                <a href="{{url()->previous()}}" class="m-lg-1 btn btn-primary">Volver</a>
            </div>
        </div>

        <div class="card" style="width: 30rem; padding: 1rem;">
            @include('video.commets')
        </div>
    </div>
@endsection

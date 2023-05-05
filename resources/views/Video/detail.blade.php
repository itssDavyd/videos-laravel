@extends('layouts.app')
@section('content')

    <div class="container-submain" style="display: flex;justify-content: center;">
        <div class="card" style="width: 30rem;">
            <<img class="video_image" src="{{url('/miniatura/'.$video->image)}}"
                  alt="miniatura">
            <div class="card-header">
                {{$video->title}}
            </div>
            <div class="card-body">

                <p class="card-text">
                    {{$video->description}}
                </p>
            </div>
            <div class="card-footer">
                <a href="{{url()->previous()}}" class="m-lg-1 btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="container">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                @endif

                <div id="videos-list">
                    @foreach($videos as $video)
                        <div class="card mb-3">
                            @if(!empty($video->image))
                                <div class="video_image_mask">
                                    <img class="video_image" src="{{url('/miniatura/'.$video->image)}}"
                                         alt="miniatura">
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{$video->title}}</h5>
                                <p class="card-text">{{$video->description}}</p>
                                <p class="card-text"><small
                                        class="text-muted">{{$video->user->name.' '.$video->user->surname}}
                                        - {{$video->created_at}}</small></p>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('detailVideo',['video_id'=>$video->id])}}"
                                   class="btn btn-success m-lg-1">Ver</a>
                                @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->id == $video->user->id)
                                    <a href="" class="btn btn-warning  m-lg-1">Editar</a>
                                    <a href="" class="btn btn-danger  m-lg-1">Eliminar</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="pagination">
            {{$videos->links()}}
        </div>
    </div>
@endsection

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

                <ul id="videos-list">
                    @foreach($videos as $video)
                        <li class="video-item">
                            @if(\Illuminate\Support\Facades\Storage::disk('images')->has($video->image))
                                <div class="video-image-thumb">
                                    <div class="col-md-6">
                                        <img src="{{url('/miniatura/'.$video->image)}}" alt="miniatura">
                                    </div>
                                </div>

                            @endif
                            <div class="data">
                                <h3>{{$video->title}}</h3>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="pagination">
            {{$videos->links()}}
        </div>
    </div>
@endsection

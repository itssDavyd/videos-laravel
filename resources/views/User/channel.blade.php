@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="titulo-channel alert alert-info" style="text-align: center;">
                    <h2 style="font-style: italic;"><strong>Canal de {{$user->name .' '.$user->surname}}</strong></h2>
                </div>
                <div class="videos-list-include">
                    @include('Video.videosList')
                </div>
            </div>
        </div>
    </div>

@endsection

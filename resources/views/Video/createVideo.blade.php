@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <form action="{{url('/guardar-video')}}" method="POST" enctype="multipart/form-data" class="col-lg-7">
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
                <h2>Crear un video</h2>
                <hr>
                <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                </div>
                <div class="form-group">
                    <label for="description">Descripcion</label>
                    <textarea class="form-control" id="description" name="description"
                              value="{{old('title')}}"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Miniatura</label>
                    <input type="file" class="form-control" id="image" name="image" value="{{old('title')}}">
                </div>
                <div class="form-group">
                    <label for="video">Archivo de video</label>
                    <input type="file" class="form-control" id="video" name="video" value="{{old('title')}}">
                </div>
                <br>
                <button type="submit" class="btn btn-success">Crear video</button>
            </form>
        </div>
    </div>

@endsection

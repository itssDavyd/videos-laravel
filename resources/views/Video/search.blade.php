@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row" style="align-items: center;">
            <div class="alert alert-info col-md-8">
                Busqueda : {{$search}}
            </div>
            <div class="container col-md-4">
                @if(!empty($search))
                    <form class="row" action="{{route('filtro',['buscadorActivo'=>$search])}}"
                          method="get">
                        @else
                            <form class="row" action="{{url('/filtro/')}}"
                                  method="get">
                                @endif
                                <div class="col-md-8">
                                    <select class="form-select" name="filter" id="filter">
                                        @if(empty($filter))
                                            <option value="new">Mas nuevos primero</option>
                                            <option value="old">Mas antiguos primero</option>
                                            <option value="alpha">De la A a la Z</option>
                                        @else
                                            @if($filter == 'new')
                                                <option value="new" selected>Mas nuevos primero</option>
                                                <option value="old">Mas antiguos primero</option>
                                                <option value="alpha">De la A a la Z</option>
                                            @elseif($filter == 'old')
                                                <option value="new">Mas nuevos primero</option>
                                                <option value="old" selected>Mas antiguos primero</option>
                                                <option value="alpha">De la A a la Z</option>
                                            @elseif($filter == 'alpha')
                                                <option value="new">Mas nuevos primero</option>
                                                <option value="old">Mas antiguos primero</option>
                                                <option value="alpha" selected>De la A a la Z</option>
                                            @endif
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input class="btn btn-success" type="submit" value="ordenar">
                                </div>
                            </form>
                            <br>
            </div>
            <div class="container-videosList col-md-12">
                @include('Video.videosList')
            </div>
        </div>
    </div>
@endsection


@extends('layouts.master')

@section('content')
<div class="navbar navbar-nav">
    <nav class="list-group"> 
        <ul class="nav">
            <ul class="nav collapse" id="submenu1" role="menu" aria-labelledby="btn-1">
                <li>
                    <a href="{{ url('/catalog/indexGenero/1') }}" class="list-group-item">
                        Acción
                    </a>
                </li>
                <li>
                    <a href="{{ url('/catalog/indexGenero/3') }}" class="list-group-item">
                        Comedia
                    </a>
                </li>
                <li>
                    <a href="{{ url('/catalog/indexGenero/2') }}" class="list-group-item">
                        Terror
                    </a>
                </li>
                <li>
                    <a href="{{ url('/catalog/indexGenero/4') }}" class="list-group-item">
                        Drama
                    </a>
                </li>
                <li>
                    <a href="{{ url('/catalog/indexGenero/5') }}" class="list-group-item">
                        Ciencia Ficción
                    </a>
                </li>
            </ul>
        </ul>
    </nav>
</div>



<div class="row">

    @foreach( $arrayPeliculas as $pelicula )
    <div class="col-xs-6 col-sm-4 col-md-3 text-center">

        <a href="{{ url('/catalog/show/' . $pelicula->id ) }}">
            <img src="{{$pelicula->poster}}" style="height:200px"/>
            <h4 style="min-height:45px;margin:5px 0 10px 0">
                {{$pelicula->title}}
            </h4>
        </a>

    </div>
    @endforeach

</div>

@stop
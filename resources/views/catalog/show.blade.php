@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-sm-4">

        <img src="{{$pelicula->poster}}" style="height:300px"/>


    </div>
    <div class="col-sm-8">

        <h1 style="min-height:45px;margin:5px 0 10px 0">
            {{$pelicula->title}}
            @if($favorita)
            <form action="{{action('CatalogController@añadirFavorita', $pelicula->id)}}" 
                  method="POST" style="display:inline">
                {{ method_field('PUT') }}
                {{ csrf_field() }} 
                <button  class="btn btn-danger" style="display:inline"><span class="far fa-star"/>Eliminar de favoritas</button>
            </form>
            @else
            <form action="{{action('CatalogController@añadirFavorita', $pelicula->id)}}" 
                  method="POST" style="display:inline">
                {{ method_field('PUT') }}
                {{ csrf_field() }} 
                <button  class="btn btn-warning" style="display:inline"><span class="far fa-star"/>Añadir a favoritas</button>
            </form>
            @endif

        </h1 >
        <h4 style="min-height:15px;margin:5px 0 10px 0">Año: {{$pelicula->year}}</h4>
        <h4 style="min-height:15px;margin:5px 0 10px 0">Director: {{$pelicula->director}}</h4></br>
        <h4 style="min-height:15px;margin:5px 0 10px 0">Género: {{$genero->nombregenero}}</h4></br>
        <p style="min-height:10px;margin:5px 0 10px 0"><b>Resumen: </b>{{$pelicula->synopsis}}</p></br>
        <p style="min-height:10px;margin:5px 0 10px 0"><b>Estado: </b>{{$pelicula->rented?'Película actualmente alquilada.':'Película disponible.'}}</p></br>



        @if($pelicula->rented)
        <form action="{{action('CatalogController@putReturn', $pelicula->id)}}" 
              method="POST" style="display:inline">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger" style="display:inline">
                Devolver pelicula
            </button>
        </form>
        @else
        <form action="{{action('CatalogController@putRent', $pelicula->id)}}" 
              method="POST" style="display:inline">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-warning" style="display:inline">
                Alquilar pelicula
            </button>
        </form>
        @endif
        <a href="{{url('catalog/edit/'.$pelicula->id)}}" class="btn btn-warning">Editar película</a>
        <a href="{{url('catalog')}}" class="btn btn-info">Volver al listado</a>
        
        <a href="{{url('catalog/pdf/'.$pelicula->id)}}" class="btn btn-info">Descargar a PDF</a>

        <form action="{{action('CatalogController@deleteMovie', $pelicula->id)}}" 
              method="POST" style="display:inline">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger" style="display:inline">
                Eliminar película
            </button>
        </form>

    </div>
</div>
@stop
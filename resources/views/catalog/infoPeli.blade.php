

<div class="row">

    <div class="col-sm-8">

        <h1 style="min-height:45px;margin:5px 0 10px 0">
            {{$pelicula->title}}
        </h1 >
        <h4 style="min-height:15px;margin:5px 0 10px 0">Año: {{$pelicula->year}}</h4>
        <h4 style="min-height:15px;margin:5px 0 10px 0">Director: {{$pelicula->director}}</h4></br>
        <h4 style="min-height:15px;margin:5px 0 10px 0">Género: {{$genero->nombregenero}}</h4></br>
        <p style="min-height:10px;margin:5px 0 10px 0"><b>Resumen: </b>{{$pelicula->synopsis}}</p></br>
        <p style="min-height:10px;margin:5px 0 10px 0"><b>Estado: </b>{{$pelicula->rented?'Película actualmente alquilada.':'Película disponible.'}}</p></br>

    </div>
</div>

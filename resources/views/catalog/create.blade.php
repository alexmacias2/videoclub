@extends('layouts.master')

@section('content')


<div class="row" style="margin-top:40px">
    <div class="offset-md-3 col-md-6">
        <div class="card">
            <div class="card-header text-center">
                Añadir película
            </div>
            <div class="card-body" style="padding:30px">

                <form action="#" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>

                    <div class="form-group">
                       <label for="title">Año</label>
                        <input type="text" name="year" id="title" class="form-control">
                    </div>
                    
                    <div>
                        <label for="title">Género</label>
                        <select name="genero">
                            <option id="1" value="1">Acción</option>
                            <option id="2" value="2">Terror</option>
                            <option id="3" value="3">Comedia</option>
                            <option id="4" value="4">Drama</option>
                            <option id="5" value="5">Ciencia ficción</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Director</label>
                        <input type="text" name="director" id="title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="title">Poster</label>
                        <input type="text" name="poster" id="title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="synopsis">Resumen</label>
                        <textarea name="synopsis" id="synopsis" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                            Añadir película
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


@stop
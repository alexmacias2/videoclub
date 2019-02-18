<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Genero;
use App\MoviesUser;
use Illuminate\Database;
use Notification;

class CatalogController extends Controller {

    public function getIndex() {
        $movies = Movie::all();
        return view('catalog.index', array('arrayPeliculas' => $movies));
    }

    public function getShow($id) {
        $movie = Movie::findOrFail($id);
        $genero = Genero::findOrFail($movie->idgenero);
        $userid = auth()->user()->id;
        return view('catalog.show', array('pelicula' => $movie, 'genero' => $genero, 'userid' => $userid));
    }

    public function getCreate() {

        return view('catalog.create');
    }

    public function getEdit($id) {
        $movie = Movie::findOrFail($id);
        return view('catalog.edit', array('pelicula' => $movie));
    }

    public function postCreate(Request $request) {
        $p = new Movie;
        $p->title = $request->input('title');
        $p->year = $request->input('year');
        $p->director = $request->input('director');
        $p->poster = $request->input('poster');
        $p->rented = $request->input('rented');
        $p->synopsis = $request->input('synopsis');
        $p->rented = false;
        $p->save();

        Notification::success('La peícula se a añadido correctamente');
        return redirect('catalog');
    }

    public function putEdit(Request $request, $id) {
        $p = Movie::findOrFail($id);
        $p->title = $request->input('title');
        $p->year = $request->input('year');
        $p->director = $request->input('director');
        $p->poster = $request->input('poster');
        $p->rented = false;
        $p->synopsis = $request->input('synopsis');
        $p->save();

        Notification::success('La película se modificado correctamente');
        return redirect('catalog/show/' . $p->id);
    }

    public function putRent(Request $request, $id) {
        $p = Movie::findOrFail($id);
        $p->rented = true;
        $p->save();
        Notification::success('La pelicula se ha alquilado');
        return redirect('catalog/show/' . $p->id);
    }

    public function putReturn(Request $request, $id) {
        $p = Movie::findOrFail($id);
        $p->rented = false;
        $p->save();
        Notification::success('La pelicula se ha devuelto');
        return redirect('catalog/show/' . $p->id);
    }

    public function deleteMovie(Request $request, $id) {
        $p = Movie::findOrFail($id);
        $p->delete();
        Notification::success('La pelicula se ha eliminado');
        return redirect('catalog');
    }

    public function añadirFavorita(Request $request, $id) {

        $userid = auth()->user()->id;
        $movieid = $id;
        $existe = MoviesUser::where('user_id', '=', $userid)
                ->where('movie_id', '=', $id)
                ->first();
        if ($existe != null) {
            Notification::error('La peli ya existe');
            return redirect('catalog/show/' . $movieid);
        } else {
            $favorita = new MoviesUser();
            $favorita->movie_id = $movieid;
            $favorita->user_id = $userid;
            $favorita->save();
            Notification::success('La peli se ha añadido a favoritos');
            return redirect('catalog/show/' . $movieid);
        }

    }

}

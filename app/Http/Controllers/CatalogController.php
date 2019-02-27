<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Genero;
use App\MoviesUser;
use Illuminate\Database;
use Notification;
use PDF;

class CatalogController extends Controller {

    public function getIndex() {
        $movies = Movie::all();
        return view('catalog.index', array('arrayPeliculas' => $movies));
    }

    public function getFavoritas() {
        $userid = auth()->user()->id;
        $moviesFavoritas = MoviesUser::where('user_id', '=', $userid)->get();
        $movies = array();
        foreach ($moviesFavoritas as &$valor) {
            $aux = Movie::find($valor->movie_id);
            array_push($movies, $aux);
        }

        return view('catalog.indexFavoritas', array('arrayPeliculas' => $movies));
    }

    public function getShow($id) {
        $movie = Movie::findOrFail($id);
        $genero = Genero::findOrFail($movie->idgenero);
        $userid = auth()->user()->id;
        if (MoviesUser::where('user_id', '=', $userid)
                        ->where('movie_id', '=', $id)
                        ->first() != null) {
            $favorita = true;
        } else {
            $favorita = false;
        }
        return view('catalog.show', array('pelicula' => $movie, 'genero' => $genero, 'userid' => $userid, 'favorita' => $favorita));
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
        $p->idgenero=$request->input('genero');
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
        $p->idgenero=$request->input('genero');
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
            $existe->delete();
            Notification::error('La película se ha eliminado de favoritos');
            return redirect('catalog/show/' . $movieid);
        } else {
            $favorita = new MoviesUser();
            $favorita->movie_id = $movieid;
            $favorita->user_id = $userid;
            $favorita->save();
            Notification::success('La película se ha añadido a favoritos');
            return redirect('catalog/show/' . $movieid);
        }
    }
    
    public function getIndexGenero($id){
        $moviesGenero = Movie::where('idgenero', '=', $id)->get();
        return view('catalog.indexGenero', array('arrayPeliculas' => $moviesGenero));
    }
    
    public function getPdfMovie($id){
        $movie = Movie::findOrFail($id);
        $genero = Genero::findOrFail($movie->idgenero);
        $userid = auth()->user()->id;
        if (MoviesUser::where('user_id', '=', $userid)
                        ->where('movie_id', '=', $id)
                        ->first() != null) {
            $favorita = true;
        } else {
            $favorita = false;
        }
       $pdf = PDF::loadView('catalog.infoPeli', array('pelicula' => $movie, 'genero' => $genero, 'userid' => $userid, 'favorita' => $favorita));
       return $pdf->download('pelicula.pdf');
    }

}

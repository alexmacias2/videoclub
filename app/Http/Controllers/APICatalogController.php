<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class APICatalogController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response()->json(Movie::all());
    }

  
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $p = new Movie;
        $p->title = $request->input('title');
        $p->year = $request->input('year');
        $p->director = $request->input('director');
        $p->poster = $request->input('poster');
        $p->rented = $request->input('rented');
        $p->synopsis = $request->input('synopsis');
        $p->rented = false;
        $p->save();
        return response()->json(['success' => false,
                    'msg' => 'La película se ha creado']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return response()->json(Movie::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return response()->json(Movie::findOrFail($id));
    }

    public function putRent($id) {
        $m = Movie::findOrFail($id);
        $m->rented = true;
        $m->save();
        return response()->json(['error' => false,
                    'msg' => 'La película se ha marcado como alquilada']);
    }

    public function putReturn($id) {
        $m = Movie::findOrFail($id);
        $m->rented = false;
        $m->save();
        return response()->json(['warning' => false,
                    'msg' => 'La película se ha devuelto']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $p = Movie::findOrFail($id);
        if($request->input('title')!=''){
          $p->title = $request->input('title');  
        }else{
            $p->title=$p->title;
        }
        if($request->input('year')!=''){
            $p->year = $request->input('year');
        }else{
           $p->year = $p->year;
        }
        if($request->input('director')!=''){
            $p->director=$request->input('director')!='';
        }else{
           $p->director = $p->director; 
        }
        if($request->input('poster')!=''){
             $p->poster = $request->input('poster');
        }else{
             $p->poster = $p->poster;
        }
        
        $p->rented = $p->rented;
        
        if($request->input('synopsis')!=''){
             $p->synopsis = $request->input('synopsis');
        }else{
             $p->synopsis =  $p->synopsis;
        }
        $p->save();
        return response()->json(['success' => false,
                    'msg' => 'La película se ha actualizado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $p = Movie::findOrFail($id);
        $p->delete();
        return response()->json(['error' => false,
                    'msg' => 'La película se ha eliminado']);
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Nosotro as Nosotro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NosotrosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nosotros = Nosotro::all();
        return view('administrativo.nosotros.nosotros', compact('nosotros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = new Nosotro;
        $store->titulo = $request->input('titulo');
        $store->informacion = $request->input('descripcion');
        // if ($request->hasFile('archivo')) {
        //    $filea = $request->file('archivo');
        //    $destinationPatha = 'images/nosotros/';
        //    $filea->move($destinationPatha,$filea->getClientOriginalName());
        //    $store->archivo = $destinationPatha.''.$filea->getClientOriginalName();
        // }
        $store->save();
        return back()->with('success','Su item se guardó correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nosotros = Nosotro::find($id);
        return view('administrativo.nosotros.edit', compact('nosotros'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $store = Nosotro::find($id);
        $store->titulo = $request->input('titulo');
        $store->informacion = $request->input('descripcion');
        // if ($request->hasFile('archivo')) {
        //    $filea = $request->file('archivo');
        //    $destinationPatha = 'images/nosotros/';
        //    $filea->move($destinationPatha,$filea->getClientOriginalName());
        //    $store->archivo = $destinationPatha.''.$filea->getClientOriginalName();
        // }
        // $store->titulo_proyectos = $request->input('titulo_proyectos');
        // $store->descripcion_proyectos = $request->input('descripcion_proyectos');
        $store->update();
        return back()->with('success','Su item se actualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Nosotro::find($id);
        $store->delete();
        return back()->with('success','Su item se eliminó correctamente');
    }
}

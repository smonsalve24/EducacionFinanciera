<?php

namespace App\Http\Controllers\Admin;

use App\Servicioma as Servicioma;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiciosMasController extends Controller
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
        // $servicios = Serviciomas::all();
        // return view('administrativo.servicios.servicios', compact('servicios'));
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
        $store = new Servicioma;
        $store->servicio_id = $request->input('servicio_id');
        $store->titulo = $request->input('titulo');
        $store->slug = str_slug($request->input('titulo'));
        $store->informacion = $request->input('descripcion');
        // $store->posicion = 0;
        if ($request->hasFile('archivo')) {
           $filea = $request->file('archivo');
           $destinationPatha = 'images/servicios/';
           $filea->move($destinationPatha,$filea->getClientOriginalName());
           $store->foto = $destinationPatha.''.$filea->getClientOriginalName();
        }
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
        $servicios = Servicioma::find($id);
        return view('administrativo.servicios.edit', compact('servicios'));
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
        $store = Servicioma::find($id);
        $store->titulo = $request->input('titulo');
        $store->slug = str_slug($request->input('titulo'));
        $store->informacion = $request->input('descripcion');
        // $store->posicion = 0;
        if ($request->hasFile('archivo')) {
           $filea = $request->file('archivo');
           $destinationPatha = 'images/servicios/';
           $filea->move($destinationPatha,$filea->getClientOriginalName());
           $store->foto = $destinationPatha.''.$filea->getClientOriginalName();
        }
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
        $store = Servicioma::find($id);
        $store->delete();
        return back()->with('success','Su item se eliminó correctamente');
    }
}

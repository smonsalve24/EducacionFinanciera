<?php

namespace App\Http\Controllers\Admin;

use App\Servicio as Servicio;
use App\Servicioma as Servicioma;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiciosController extends Controller
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
        $servicios = Servicio::Paginate(5);
        return view('administrativo.servicios.servicios', compact('servicios'));
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
        $store = new Servicio;
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
        $servicios = Servicio::find($id);
        $serviciosmas = Servicioma::where('servicio_id', '=',$id)->get();
        return view('administrativo.servicios.edit', compact('servicios','serviciosmas'));
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
        $store = Servicio::find($id);
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
        $store = Servicio::find($id);
        $store->delete();
        return back()->with('success','Su item se eliminó correctamente');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Galeria as Galeria;
use App\Http\Controllers\Controller;
use App\Proyectoma as Proyectoma;
use Illuminate\Http\Request;

class ProyectosMasController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		// $proyectos = Serviciomas::all();
		// return view('administrativo.proyectos.proyectos', compact('proyectos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$store              = new Proyectoma;
		$store->proyecto_id = $request->input('proyecto_id');
		$store->titulo      = $request->input('titulo');
		$store->slug        = str_slug($request->input('titulo'));
		$store->informacion = $request->input('descripcion');
		// $store->posicion = 0;
		if ($request->hasFile('archivo')) {
			$filea            = $request->file('archivo');
			$destinationPatha = 'images/proyectos/';
			$filea->move($destinationPatha, $filea->getClientOriginalName());
			$store->foto = $destinationPatha.''.$filea->getClientOriginalName();
		}
		$store->save();
		return back()->with('success', 'Su item se guardó correctamente');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$proyectos = Proyectoma::find($id);
		$galerias  = Galeria::where('subproyecto_id', '=', $id)->get();
		return view('administrativo.proyectos.proyectomas', compact('proyectos', 'galerias'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$store              = Proyectoma::find($id);
		$store->titulo      = $request->input('titulo');
		$store->slug        = str_slug($request->input('titulo'));
		$store->informacion = $request->input('descripcion');
		// $store->posicion = 0;
		if ($request->hasFile('archivo')) {
			$filea            = $request->file('archivo');
			$destinationPatha = 'images/proyectos/';
			$filea->move($destinationPatha, $filea->getClientOriginalName());
			$store->foto = $destinationPatha.''.$filea->getClientOriginalName();
		}
		$store->update();
		return back()->with('success', 'Su item se actualizó correctamente');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$store = Proyectoma::find($id);
		$store->delete();
		return back()->with('success', 'Su item se eliminó correctamente');
	}
}

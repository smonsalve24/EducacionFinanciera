<?php

namespace App\Http\Controllers\Admin;

use App\Galeria as Galeria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GaleriaController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		// $nosotros = Nosotro::OrderBy('nombre', 'ASC');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$nosotros         = new Galeria;
		$nosotros->titulo = $request->input('titulo');
		if ($request->hasFile('foto')) {
			$filea            = $request->file('foto');
			$destinationPatha = 'images/galeria/';
			$filea->move($destinationPatha, $filea->getClientOriginalName());
			$nosotros->foto = $destinationPatha.''.$filea->getClientOriginalName();
		}
		$nosotros->proyecto_id    = $request->input('proyecto_id');
		$nosotros->subproyecto_id = $request->input('subproyecto_id');
		$nosotros->servicios_id   = $request->input('servicios_id');
		$nosotros->productos_id   = $request->input('productos_id');
		$nosotros->save();
		return back()->with('success', 'Su item se guardó exitosamente.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
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
		$nosotros         = Galeria::find($id);
		$nosotros->titulo = $request->input('titulo');
		if ($request->hasFile('foto')) {
			$filea            = $request->file('foto');
			$destinationPatha = 'images/galeria/';
			$filea->move($destinationPatha, $filea->getClientOriginalName());
			$nosotros->foto = $destinationPatha.''.$filea->getClientOriginalName();
		}
		// $nosotros->proyecto_id    = $request->input('proyecto_id');
		// $nosotros->servicios_id    = $request->input('servicios_id');
		// $nosotros->productos_id    = $request->input('productos_id');
		$nosotros->update();
		return back()->with('success', 'Su item se actualizó exitosamente.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$nosotros = Galeria::find($id);
		$nosotros->delete();
		return back()->with('success', 'Su item se eliminó exitosamente.');
	}
}

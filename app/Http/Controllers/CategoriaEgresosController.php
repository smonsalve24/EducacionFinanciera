<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria_egreso;

class CategoriaEgresosController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catEgreso = Categoria_egreso::all();
        return view('administrativo.categoriaEgresos.categorias', compact('catEgreso'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'nombre_categoria' => 'required',
            'mensaje' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $store = new Categoria_egreso;
            $store->tipo_egreso = '1';
            $store->nombre = $request->input('nombre_categoria');
            // $store->mensaje = $request->input('mensaje');
            if ($store->save()) {

                return back()->with('success', 'Su categoría se guardó correctamente');
            } else {
                return back()->with('error', 'Su categoría no se guardó correctamente');

            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = \Validator::make($request->all(), [
            'nombre_categoria' => 'required',
            'mensaje' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $store = Categoria_egreso::find($id);
            $store->tipo_egreso = '1';
            $store->nombre = $request->input('nombre_categoria');
            // $store->mensaje = $request->input('mensaje');
            if ($store->update()) {

                return back()->with('success', 'Su categoría se guardó correctamente');
            } else {
                return back()->with('error', 'Su categoría no se guardó correctamente');

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $store = Categoria_egreso::find($id);
        $store->delete();
        return back()->with('success', 'Su item se eliminó correctamente');
    }
}

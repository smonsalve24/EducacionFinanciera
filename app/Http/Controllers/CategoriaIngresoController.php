<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria_ingreso;

class CategoriaIngresoController extends Controller
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
        $catIngreso = Categoria_ingreso::all();
        return view('administrativo.categoriaIngresos.categoria', compact('catIngreso'));
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
            $store = new Categoria_ingreso;
            $store->tipo_ingreso = '1';
            $store->nombre = $request->input('nombre_categoria');
            $store->mensaje = $request->input('mensaje');
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
            $store = new Categoria_ingreso;
            $store->tipo_ingreso = '1';
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
        $store = Categoria_ingreso::find($id);
        $store->delete();
        return back()->with('success', 'Su item se eliminó correctamente');
    }
}

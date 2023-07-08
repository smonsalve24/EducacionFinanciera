<?php

namespace App\Http\Controllers;

use App\Models\Ingreso as Ingreso;
use App\Models\Categoria_ingreso as Categoria_ingreso;

use Illuminate\Http\Request;

class IngresosController extends Controller
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
        // return "hola";
        $ingresos = Ingreso::all();
        $categorias = Categoria_ingreso::all();
        return view('administrativo.ingresos.ingreso', compact('ingresos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria_ingreso::all();
        return view('administrativo.ingresos.create', compact('categorias'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'valor' => 'required',
            'fecha' => 'required',
            'titulo' => 'required',
            'categoria_ingreso_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $store = new Ingreso;
            $store->valor = $request->input('valor');
            $store->fecha = $request->input('fecha');;
            $store->titulo = $request->input('titulo');
            $store->categoria_ingreso_id = $request->input('categoria_ingreso_id');

            if ($store->save()) {

                return back()->with('success', 'Su item se guardó correctamente');
            } else {
                return back()->with('error', 'Su item no se guardó correctamente');

            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

         // return "hola";
        $ingresos = Ingreso::find($id);
        $categorias = Categoria_ingreso::all();
        return view('administrativo.ingresos.edit', compact('categorias', 'ingresos'));
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
            'valor' => 'required',
            'fecha' => 'required',
            'titulo' => 'required',
            'categoria_ingreso_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $store = Ingreso::find($id);
            $store->valor = $request->input('valor');
            $store->fecha = $request->input('fecha');;
            $store->titulo = $request->input('titulo');
            $store->categoria_ingreso_id = $request->input('categoria_ingreso_id');

            if ($store->save()) {

                return back()->with('success', 'Su item se guardó correctamente');
            } else {
                return back()->with('error', 'Su item no se guardó correctamente');

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $store = Ingreso::find($id);
        $store->delete();
        return back()->with('success', 'Su item se eliminó correctamente');
    }
}

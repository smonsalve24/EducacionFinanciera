<?php

namespace App\Http\Controllers;

use App\Models\Egreso as Egreso;
use App\Models\Categoria_egreso as Categoria_egreso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EgresosController extends Controller
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
         $egresos = Egreso::all();
         $categorias = Categoria_egreso::all();
         return view('administrativo.egresos.egreso', compact('egresos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria_egreso::all();
        return view('administrativo.egresos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'valor' => 'required',
            'fecha' => 'required',
            'descripcion' => 'required',
            'categoria_egreso_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $store = new Egreso;
            $store->valor = $request->input('valor');
            $store->fecha = $request->input('fecha');;
            $store->descripcion = $request->input('descripcion');
            $store->persona_id = @Auth::user()->id;
            $store->categoria_egreso_id = $request->input('categoria_egreso_id');

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
        {

            // return "hola";
           $egresos = Egreso::find($id);
           $categorias = Categoria_egreso::all();
           return view('administrativo.egresos.edit', compact('categorias', 'egresos'));
       }
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
            'descripcion' => 'required',
            'categoria_egreso_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $store = Egreso::find($id);
            $store->valor = $request->input('valor');
            $store->fecha = $request->input('fecha');;
            $store->descripcion = $request->input('descripcion');
            $store->persona_id = @Auth::user()->id;
            $store->categoria_egreso_id = $request->input('categoria_egreso_id');

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
        $store = Egreso::find($id);
        $store->delete();
        return back()->with('success', 'Su item se eliminó correctamente');
    }
}

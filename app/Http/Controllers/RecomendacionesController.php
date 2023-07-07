<?php

namespace App\Http\Controllers;

use App\Models\Recomendacion as Recomendacion;
use Illuminate\Http\Request;

class RecomendacionesController extends Controller
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
        $recomendaciones = Recomendacion::all();
        return view('administrativo.recomendaciones.recomendacion', compact('recomendaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrativo.recomendaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required',
            'mensaje' => 'required',
            'recomendacion' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $store = new Recomendacion;
            $store->email = $request->input('email');
            $store->mensaje = $request->input('mensaje');
            $store->recomendacion = $request->input('recomendacion');
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
        $recomendacion = Recomendacion::find($id);
        return view('administrativo.recomendaciones.edit', compact('recomendacion'));
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
            'email' => 'required',
            'mensaje' => 'required',
            'recomendacion' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $store = Recomendacion::find($id);
            $store->email = $request->input('email');
            $store->mensaje = $request->input('mensaje');
            $store->recomendacion = $request->input('recomendacion');
            if ($store->update()) {

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
        $store = Recomendacion::find($id);
        $store->delete();
        return back()->with('success', 'Su item se eliminó correctamente');
    }
}

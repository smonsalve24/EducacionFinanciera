<?php

namespace App\Http\Controllers;

use App\Models\Alerta as Alerta;
use Illuminate\Http\Request;

class AlertasController extends Controller
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
        $alertas = Alerta::all();
        return view('administrativo.alertas.alerta', compact('alertas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrativo.alertas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email_users' => 'required',
            'tipo_alerta' => 'required',
            'mensaje' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $store = new Alerta;
            $store->email_users = $request->input('email_users');
            $store->tipo_alerta = $request->input('tipo_alerta');
            $store->mensaje = $request->input('mensaje');
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
        $alerta = Alerta::find($id);
        return view('administrativo.alertas.edit', compact('alerta'));
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
            'email_users' => 'required',
            'tipo_alerta' => 'required',
            'mensaje' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $store = Alerta::find($id);
            $store->email_users = $request->input('email_users');
            $store->tipo_alerta = $request->input('tipo_alerta');
            $store->mensaje = $request->input('mensaje');
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
        $store = Alerta::find($id);
        $store->delete();
        return back()->with('success', 'Su item se eliminó correctamente');
    }
}
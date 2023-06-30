<?php

namespace App\Http\Controllers\Admin;

use App\Contacto as Contacto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactoController extends Controller
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
        $contacto = Contacto::all();
        return view('administrativo.contacto.contacto', compact('contacto'));
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
        $validator = \Validator::make($request->all(), [
                'nombre'  => 'required|string',
                'email'      => 'required',
                'telefono' => 'required|numeric',
                'comentarios'   => 'required',
                // 'condiciones' => 'required',
            ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        } else {
            $store = new Contacto;
            $store->nombre = $request->input('nombre');
            $store->email = $request->input('email');
            $store->telefono = $request->input('telefono');
            $store->comentarios = $request->input('comentarios');
            $store->save();
            return back()->with('success','Su item se guardó correctamente');

            $nombre      = $request->input('nombre');
            $email       = $request->input('email');
            $telefono    = $request->input('telefono');
            $comentarios = $request->input('comentarios');
            $fecha       = date('d - M - Y');

            $para = "bayronbb@gmail.com";
            // $para      = "bayronbb@gmail.com";
            $titulo  = "Contacto web ABBA Padres";
            $mensaje = "Nombre y Apellidos : $nombre \r\n" .
            "Correo:  $email \r\n" .
            "Telefono:  $telefono \r\n" .
            "Mensaje: $comentarios \r\n" .
            "Fecha: $fecha \r\n";

            $cabeceras = "From: ABBA Soluciones WEB";
            mail($para, $titulo, $mensaje, $cabeceras);
            return back()->withErrors(array('success' => 'Su registro fue exitoso !!'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contacto = Contacto::find($id);
        return view('administrativo.contacto.edit', compact('contacto'));
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
        $store = Contacto::find($id);
        $store->nombre = $request->input('nombre');
        $store->email = $request->input('email');
        $store->telefono = $request->input('telefono');
        $store->comentarios = $request->input('comentarios');
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
        $store = Contacto::find($id);
        $store->delete();
        return back()->with('success','Su item se eliminó correctamente');
    }
}

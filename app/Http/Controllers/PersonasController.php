<?php

namespace App\Http\Controllers;

use App\Models\Persona as Persona;
use App\Models\User as User;
use Illuminate\Http\Request;

class PersonasController extends Controller
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
        $personas = Persona::all();
        $usuarios = User::all();
        return view('administrativo.personas.persona', compact('personas', 'usuarios'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personas = User::all();

         return view('administrativo.personas.create', compact('personas'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'persona_id' => 'required|unique:personas',
            'rol' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $store = new Persona;
            $store->persona_id = $request->input('persona_id');
            $store->nombre = 'd';
            $store->rol = $request->input('rol');
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
        $persona = Persona::find($id);
        $personas = User::where('id', '=', $persona['persona_id'])->get();
        return view('administrativo.personas.edit', compact('persona','personas'));
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
            'persona_id' => 'required',
            'rol' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $store = Persona::find($id);
            $store->persona_id = $request->input('persona_id');
            $store->nombre = 'hola';
            $store->rol = $request->input('rol');
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
        $store = Persona::find($id);
        $store->delete();
        return back()->with('success', 'Su item se eliminó correctamente');
    }
}

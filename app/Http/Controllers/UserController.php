<?php

namespace App\Http\Controllers;

use App\Models\User as User;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $users = User::all();
        return view('administrativo.users.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrativo.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $store = new User;
            $store->name = $request->input('name');
            $store->email = $request->input('email');
            $store->password = $request->input('password');
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
        $user = User::find($id);
        return view('administrativo.users.edit', compact('user'));
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $store = User::find($id);
            $store->name = $request->input('name');
            $store->email = $request->input('email');
            $store->password = $request->input('password');
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
        $store = User::find($id);
        $store->delete();
        return back()->with('success', 'Su item se eliminó correctamente');
    }
}

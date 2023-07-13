<?php

namespace App\Http\Controllers;

use App\Models\Ingreso as Ingreso;
use App\Models\Egreso as Egreso;
use App\Models\Historico as Historico;
use App\Models\Recomendacion as Recomendacion;
use App\Models\Categoria_ingreso as Categoria_ingreso;
use App\Models\Categoria_egreso as Categoria_egreso;
use App\Models\Alerta as Alerta;

use App\Exports\HistoryExport;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class HistoricosController extends Controller
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
        $ingresos = Ingreso::where('persona_id', '=', Auth::user()->id)->orderBy('fecha', 'DESC')->get();
        $egresos = Egreso::where('persona_id', '=', Auth::user()->id)->orderBy('fecha', 'DESC')->get();
        $arrayList = array_merge($ingresos->toArray(), $egresos->toArray());
        usort($arrayList, function ($a, $b) {
            return strcmp($b["fecha"], $a["fecha"]);
        });
        $historicos = Historico::all();
        $recomendaciones = Recomendacion::all();
        $categorias = Categoria_ingreso::all();
        $categoriasE = Categoria_egreso::all();
        $alertas = Alerta::OrderBy('email_users', 'DESC')->get();
        return view('administrativo.historico.historico', compact('historicos', 'recomendaciones','categorias','arrayList','categoriasE', 'alertas'));
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
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        return Excel::download(new HistoryExport($request->input('fecha')), 'movementHistory.xlsx');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}

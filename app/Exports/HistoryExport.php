<?php
namespace App\Exports;
use App\Models\Ingreso as Ingreso;
use App\Models\Egreso as Egreso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class HistoryExport implements FromView{
    protected $fecha;

    function __construct($fecha) {
        $this->fecha = $fecha;
 }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        if($this->fecha != ''){
            $ingresos = Ingreso::where('persona_id', '=', Auth::user()->id)->where('fecha', '>=', $this->fecha)->orderBy('fecha', 'DESC')->get();
            $egresos = Egreso::where('persona_id', '=', Auth::user()->id)->where('fecha', '>=', $this->fecha)->orderBy('fecha', 'DESC')->get();
            $arrayList = array_merge($ingresos->toArray(), $egresos->toArray());
            usort($arrayList, function ($a, $b) {
                return strcmp($b["fecha"], $a["fecha"]);
            });
            return view('administrativo.historico.table', compact('arrayList'));
        }else{
            $ingresos = Ingreso::where('persona_id', '=', Auth::user()->id)->orderBy('fecha', 'DESC')->get();
            $egresos = Egreso::where('persona_id', '=', Auth::user()->id)->orderBy('fecha', 'DESC')->get();
            $arrayList = array_merge($ingresos->toArray(), $egresos->toArray());
            usort($arrayList, function ($a, $b) {
                return strcmp($b["fecha"], $a["fecha"]);
            });
            return view('administrativo.historico.table', compact('arrayList'));
        }
        
    }
}
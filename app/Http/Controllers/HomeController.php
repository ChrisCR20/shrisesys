<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tipousuario= Auth::user()->hasRole('basic');
        
        if($tipousuario==true){
            return view('home');
        }
        else{
        $ventas= DB::table('encabezado_factura')
        ->select(DB::raw('count(id_encabezadof) as ventas'))
        ->get();

        $productos= DB::table('producto')
        ->select(DB::raw('count(id_producto) as productos'))
        ->get();

        $compras= DB::table('encabezado_facturac')
        ->select(DB::raw('count(id_encabezadofacturaC) as compras'))
        ->get();

        $clientes= DB::table('cliente')
        ->select(DB::raw('count(id_cliente) as clientes'))
        ->get();
        return view('home2',compact('ventas','productos','compras','clientes'));
        }
        
        //dd($ventas);
        
  
    }

    public function topproductos(Request $request)
    {
        $item = DB::table('detalle_factura as df')
        ->join('producto as pr','df.id_producto','=','pr.id_producto')
        ->select('pr.nombreproducto',DB::raw('sum(df.cantidad) as cantidad'))
        ->groupBy('pr.nombreproducto')
        ->orderBy('cantidad','desc')
        ->limit(7)
        ->get();

                    //dd(Arr::get($data,'idsedecentral'));
                    if(count($item) ==0){
                        $etapas1=[];
                    }else{
                    foreach($item as $data1 => $valor){
                        $etapas1[] = (array)$valor;
                    }}

                   
        return response()->json($etapas1);
        
    }

    public function revenuepermonth(Request $request){
        $revenues = DB::table('encabezado_factura as ef')
        ->join('detalle_factura as df','ef.id_encabezadof','=','df.id_encabezadof')
        ->join('producto as pr','df.id_producto','=','pr.id_producto')
        ->select(DB::raw('sum(df.subtotal) as venta'),DB::raw('month(ef.fecha) as mes'))
        ->where(DB::raw('year(ef.fecha)'),'=',now()->toDate('Y'))
        ->groupBy('mes')
        ->orderBy('mes','asc')
        ->get();

        if(count($revenues) ==0){
            $etapas1=[];
        }else{
        foreach($revenues as $revenues => $valor){
            $etapas1[] = (array)$valor;
        }}

       
return response()->json($etapas1);


    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\detalle_factura;
use App\Models\encabezado_factura;
use PDF;

use DB;
class ventaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function card1($id)
    {
        //dd($id);
        $producto=DB::table('producto')->select('id_producto','nombreproducto','cantidad','nombrecategoria','nombremedida','nombremarca')
        ->join('categoría','categoría.id_categoria','=','producto.id_categoria')
        ->join('marca','marca.id_marca','=','producto.id_marca')
        ->join('medida','medida.id_medida','=','producto.id_medida')
        ->join('sucursal as su','su.id_sucursal','=','producto.id_sucursal')
        ->join('sucursal_empleado as se','se.id_sucursal','=','su.id_sucursal')
        ->where('se.id_persona','=',Auth::user()->id_empleado)
        ->where('nombreproducto','LIKE','%'.$id.'%')
        ->orderby('id_producto','desc')
        ->get();
        
        if(count($producto)<1){
            $producto=DB::table('producto')->select('id_producto','nombreproducto')
        ->orderby('id_producto','desc')
        ->get();
        return view('venta.cardvacia');
        }
        else{
            return view('venta.card',compact('producto'));
        }

      //  dd($producto);
       
    }
    public function create()
    {
        //
        $tipopago = DB::table('tipo_pago')
        ->select('id_tipopago','nombretipo')
        ->get();

        $producto=DB::table('producto')->select('id_producto','nombreproducto')
        ->orderby('id_producto','desc')
        ->get();
        return view('venta.pos',['tipopago'=>$tipopago,'producto'=>$producto]);
    }

    public function getnit($nit)
    {
        Auth::user()->id;

        $persona = DB::table('cliente')
        ->select('nombrecliente', 'id_cliente', 'emailcliente')
        ->where('nitcliente', '=', $nit)
        ->first();

        //dd($persona);

         return response()->json($persona);
    }

    public function getunitario($id)
    {

        $punitario = DB::table('producto')
        ->select('precio_venta', 'id_producto','cantidad')
        ->where('id_producto', '=', $id)
        ->first();

         return response()->json($punitario);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id= auth()->user()->identificacion;

        $sucursalemp= DB::table('empleado as e')
        ->join('sucursal_empleado as se','se.id_persona','=','e.id_empleado')
        ->select('se.id_sucursal')
        ->where('e.codunicoid','=',$id)
        ->get();

        $caja=DB::table('caja')
        ->select('caja.montoinicial','caja.id_caja')
        ->where('caja.id_sucursal','=',$sucursalemp[0]->id_sucursal)
        ->where('caja.estado','=','1')
        ->get();
  
        $miArrayPA = $request->nmtitulo;
        //dd($request->input('fechafactv'));
        $facturaC = new encabezado_factura;
        $facturaC->id_cliente = $request->input('id_cliente');
        $facturaC->id_tipopago = $request->input('id_tipopago');
        $facturaC->id_sucursal = $request->input('id_sucursal');
        $facturaC->fecha = $request->input('fechafactv');
        $facturaC->id_caja = $caja[0]->id_caja;
        $facturaC->save();

        $cont =0;
        if ($miArrayPA > 0)
        {
            while($cont < count($request->nmtitulo))
            {
        $detallefacturaC = new detalle_factura;
        $detallefacturaC->id_encabezadof =$facturaC->id_encabezadof;
        $detallefacturaC->id_producto = $request->tpgrado[$cont];
        $detallefacturaC->subtotal =$request->nmtitulo[$cont];
        $detallefacturaC->cantidad =$request->nminstituto[$cont];
        $detallefacturaC->save();
        $cont=$cont + 1;
            }}

        
        $encabezadof =  DB::table('encabezado_factura')
        ->where('encabezado_factura.id_encabezadof','=',$facturaC->id_encabezadof)
        ->get();
        
        $detallef= DB::table('detalle_factura')
        ->join('producto','producto.id_producto','=','detalle_factura.id_producto')
        ->where('detalle_factura.id_encabezadof','=',$facturaC->id_encabezadof)
        ->select('producto.nombreproducto','detalle_factura.cantidad','detalle_factura.subtotal')
        ->get();
//dd($detallef);

        $orden=$facturaC->id_encabezadof;
  
        $cliente = DB::table('cliente')
        ->where('cliente.id_cliente','=',$request->input('id_cliente'))
        ->get();

        $pago = DB::table('tipo_pago')
        ->where('tipo_pago.id_tipopago','=',$request->input('id_tipopago'))
        ->get();
        $pdf = PDF::loadView('imprimir',compact('cliente','pago','orden','detallef','encabezadof'));
        $path = public_path('facturas');
        $fileName =  time().'.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);

        $pdf = public_path('facturas/'.$fileName);
        return response()->download($pdf);

        
            // $pdf = PDF::loadView('imprimir');
            // return $pdf->download('imprimir.pdf');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

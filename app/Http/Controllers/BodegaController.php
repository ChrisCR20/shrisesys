<?php

namespace App\Http\Controllers;

use DB;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\detalle_factura;
use App\Models\encabezado_factura;
use PDF;
use PhpParser\Node\Expr\FuncCall;

class BodegaController extends Controller
{
    //

    public function index(Request $request){

        if($request->ajax())
        {      
            $data = DB::table('encabezado_factura')->select('encabezado_factura.id_encabezadof as id_encabezadof','cliente.nombrecliente as nombrecliente','encabezado_factura.fecha as fecha')
            ->join('cliente','cliente.id_cliente','=','encabezado_factura.id_cliente')
            ->get();
            //   $datos = json_decode($data,true);
            //dd($data);
            //dd(Arr::get($data,'idsedecentral'));
            if(count($data) ==0){
                $etapas=[];
            }else{
            foreach($data as $data => $valor){
                $etapas[] = (array)$valor;
            }}
           //dd($etapas[0]['idsedecentral']);

             return datatables()->of($etapas)->addColumn('action',function ($row){
                 $btn = '<a class="btn  btn-md" style="color:#123D6C" title="Editar"  href="verentrega/'.$row['id_encabezadof'].'" ><div><i class="fa fa-eye"></i></div></a>';

               // $btn = '<button type="button" onClick="editar('.$row['id_sede'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';
                return $btn;
             
             })->rawColumns(['action'])->make(true);
        }

        return view('bodega.index');
    }

    public function create()
    {
        $Cliente=DB::table('cliente')->select('id_cliente','nombrecliente')
        ->orderby('id_cliente','desc')
        ->get();
    
        return view('bodega.create',compact('Cliente'));
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

    public function getunitario($id,$cl)
    {
        //dd($cl);
        $punitario = DB::table('producto as p')
        ->join('medida as m','m.id_medida','=','p.id_medida')
        ->join('presentacion_cliente as pc','pc.id_presentacion','=','m.id_medida')
        ->select('pc.precio', 'p.id_producto','cantidad')
        ->where('id_producto', '=', $id)
        ->where('id_cliente','=',$cl)
        ->first();

        //dd($punitario);
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
        $facturaC->id_tipopago = '1';
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
        $pdf = PDF::loadView('recibobodega',compact('cliente','pago','orden','detallef','encabezadof'));
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
    public function edit(Request $request,$id)
    {
        //

        $cliente = DB::table('cliente')->select('id_cliente', 'nombrecliente')
        ->orderby('id_cliente', 'desc')
        ->get();

        $data = DB::table('encabezado_factura as ef')
        ->join('cliente','cliente.id_cliente','=','ef.id_cliente')
        ->select('ef.id_encabezadof', 'cliente.nombrecliente','ef.fecha')
        ->where('ef.id_encabezadof', '=', $id)
        ->get();

        


        if($request->ajax())
        {
            

            $data1 = DB::table('encabezado_factura as ef')
            ->join('detalle_factura as df','ef.id_encabezadof','=','df.id_encabezadof')
            ->join('producto as pr','df.id_producto','=','pr.id_producto')
            ->select('df.id_detallef','df.cantidad','pr.nombreproducto')
            ->where('ef.id_encabezadof','=',$id)
            ->get();
            
         //   $datos = json_decode($data,true);
            //dd($data);
            //dd(Arr::get($data,'idsedecentral'));
            if(count($data1) ==0){
                $etapas1=[];
            }else{
            foreach($data1 as $data1 => $valor){
                $etapas1[] = (array)$valor;
            }}


             return datatables()->of($etapas1)->addColumn('action',function ($row){
   
             
             })->rawColumns(['action'])->make(true);
        }

        if(count($data) ==0){
            $etapas=[];
        }else{
        foreach($data as $data => $valor){
            $etapas[] = (array)$valor;
        }}

        //dd($etapas);
        return view('bodega.detalle',['cliente'=>$cliente,'etapas'=>$etapas]);
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

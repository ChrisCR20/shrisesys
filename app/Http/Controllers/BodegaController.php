<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use DB;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\detalle_factura;
use App\Models\encabezado_factura;
use App\Models\Producto;
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
            ->where('encabezado_factura.status','=','1')
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
                 $btn = '<a class="btn  btn-md" style="color:#123D6C" title="Ver"  href="verentrega/'.$row['id_encabezadof'].'" ><div><i class="fa fa-eye"></i></div></a>';

               // $btn = '<button type="button" onClick="editar('.$row['id_sede'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';
                return $btn;
             
             })->addColumn('editar',function ($row){
                Auth::user()->hasPermissionTo('pedidos.edit')
                ? $btn2 = '<a class="btn btn-md" style="color:#FF5733 " title="Editar" href="indexedit/'.$row['id_encabezadof'].'" class="delete btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></a>'
                : $btn2= ' ';
                //$btn1 ='<button type="button" onClick="eliminar('.$row['id_cedecentral'].','.$row['id_status'].');" class="delete btn btn-info btn-sm"><div><i class="fa fa-retweet"></i></div></button>';
                return $btn2;
             })->addColumn('reimpresion',function ($row){
                $btn1 = '<a type="button" title="Re-imprimir" href="reimpresion/'.$row['id_encabezadof'].'" class="delete btn btn-warning btn-sm"><div><i class="fa fa-print"></i></div></a>';

                //$btn1 ='<button type="button" onClick="eliminar('.$row['id_cedecentral'].','.$row['id_status'].');" class="delete btn btn-info btn-sm"><div><i class="fa fa-retweet"></i></div></button>';
                return $btn1;
             })->rawColumns(['action','editar','reimpresion'])->make(true);
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
        ->select('pc.precio', 'p.id_producto','p.cantidad')
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

        
        $encabezadof =  DB::table('detalle_factura')
        ->where('detalle_factura.id_encabezadof','=',$facturaC->id_encabezadof)
        ->select(DB::raw("sum(cantidad) as cantidad"))
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
        return response()->download($pdf)->deleteFileAfterSend(true);

        
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


             return datatables()->of($etapas1)->make(true);
        }

        if(count($data) ==0){
            $etapas=[];
        }else{
        foreach($data as $data => $valor){
            $etapas[] = (array)$valor;
        }}

        //dd($etapas);
        $producto = Producto::pluck('nombreproducto', 'id_producto')->all();
        return view('bodega.detalle',['cliente'=>$cliente,'etapas'=>$etapas,'producto'=>$producto]);
    }

    public function reimpresion($id)
    {
        $encabezadof =  DB::table('detalle_factura')
        ->where('detalle_factura.id_encabezadof','=',$id)
        ->select(DB::raw("sum(cantidad) as cantidad"),'id_encabezadof')
        ->get();
        
        $detallef= DB::table('detalle_factura')
        ->join('producto','producto.id_producto','=','detalle_factura.id_producto')
        ->where('detalle_factura.id_encabezadof','=',$id)
        ->select('producto.nombreproducto','detalle_factura.cantidad','detalle_factura.subtotal')
        ->get();
//dd($detallef);

        $orden=$encabezadof[0]->id_encabezadof;
  
        $cliente = DB::table('cliente')
        ->join('encabezado_factura as ec','ec.id_cliente','=','cliente.id_cliente')
        ->where('ec.id_encabezadof','=',$id)
        ->get();

        $pago = DB::table('tipo_pago')
        ->where('tipo_pago.id_tipopago','=','1')
        ->get();

        $pdf = PDF::loadView('reimpresion',compact('cliente','pago','orden','detallef','encabezadof'));
        $path = public_path('facturas');
        $fileName =  time().'.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);

        $pdf = public_path('facturas/'.$fileName);
        return response()->download($pdf)->deleteFileAfterSend(true);;
    }

    public function obteneritem($id)
    {
        $item = DB::table('detalle_factura as df')
        ->join('producto as pr', 'df.id_producto', '=', 'pr.id_producto')
        ->select('pr.nombreproducto', 'df.cantidad', 'df.subtotal', 'df.id_producto', 'df.id_detallef', 'df.id_encabezadof')
        ->where('id_detallef', '=', $id)
        ->get();

        return response()->json($item);
    }

    public function indexedit(Request $request,$id){


        $data = DB::table('encabezado_factura as ef')
        ->join('cliente','cliente.id_cliente','=','ef.id_cliente')
        ->select('ef.id_encabezadof', 'cliente.nombrecliente','ef.fecha','ef.id_cliente')
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
                 $btn = '<a class="btn  btn-md" style="color:#C8A60A" title="Editar" onClick="editarb('.$row['id_detallef'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></a>';

               // $btn = '<button type="button" onClick="editar('.$row['id_sede'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';
                return $btn;})->make(true);
        }

        if(count($data) ==0){
            $etapas=[];
        }else{
        foreach($data as $data => $valor){
            $etapas[] = (array)$valor;
        }}

        //dd($etapas);
        $producto = Producto::pluck('nombreproducto', 'id_producto')->all();
        $cliente = Cliente::pluck('nombrecliente', 'id_cliente')->all();
        // $cliente = DB::table('cliente')->select('id_cliente', 'nombrecliente')
        // ->orderby('id_cliente', 'desc')
        // ->get();
        return view('bodega.indexedit',['cliente'=>$cliente,'etapas'=>$etapas,'producto'=>$producto]);
    }

    public function actualizaritem(Request $request)
    {
        try {


            $punitario = DB::table('producto as p')
            ->join('medida as m','m.id_medida','=','p.id_medida')
            ->join('presentacion_cliente as pc','pc.id_presentacion','=','m.id_medida')
            ->select('pc.precio', 'p.id_producto','p.cantidad')
            ->where('id_producto', '=', $request->iditem)
            ->where('id_cliente','=',$request->idcl)
            ->first();

            $stockanterior = DB::table('detalle_factura as df')
            ->where('id_detallef','=',$request->iddetallec)
            ->get();

            if($request->iditem == $stockanterior[0]->id_producto ){
               
                if($request->cantidad > $stockanterior[0]->cantidad)
                {
                    
                    $cantidadreal=($request->cantidad) - ($stockanterior[0]->cantidad);
                    
                    $productoupdate = Producto::findOrFail($request->iditem);
                    $productoupdate->cantidad = ($productoupdate->cantidad) - $cantidadreal;
                    $productoupdate->save();
                  //  dd($cantidadreal);
               
                }
                else{
                    $cantidadreal=($stockanterior[0]->cantidad)-($request->cantidad);
    
                    $productoupdate = Producto::findOrFail($request->iditem);
                    $productoupdate->cantidad = ($productoupdate->cantidad) + $cantidadreal;
                    $productoupdate->save();
                    //dd($cantidadreal);
                }
    
            //dd($stockanterior);
                // Validate the value...
    
                $subtot=$request->cantidad*$punitario->precio;
       
                $detallefacturaC = detalle_factura::findOrFail($request->iddetallec);
                $detallefacturaC->id_producto = $request->iditem;
                $detallefacturaC->subtotal =$subtot;
                $detallefacturaC->cantidad =$request->cantidad;
                $detallefacturaC->save();
    
    
                $encabezado = DB::table('encabezado_factura as efc')
                ->where('id_encabezadof','=',$request->idencabe)
                ->get();
                
                return response($encabezado);

            }else{
              
                $productoretorno = Producto::findOrFail($stockanterior[0]->id_producto);
                $productoretorno->cantidad = ($productoretorno->cantidad) + $stockanterior[0]->cantidad;
                $productoretorno->save();

                $productoupdate = Producto::findOrFail($request->iditem);
                $productoupdate->cantidad = ($productoupdate->cantidad) - $request->cantidad;
                $productoupdate->save();

                $subtot=$request->cantidad*$punitario->precio;
       
                $detallefacturaC = detalle_factura::findOrFail($request->iddetallec);
                $detallefacturaC->id_producto = $request->iditem;
                $detallefacturaC->subtotal =$subtot;
                $detallefacturaC->cantidad =$request->cantidad;
                $detallefacturaC->save();

                $encabezado = DB::table('encabezado_factura as efc')
                ->where('id_encabezadof','=',$request->idencabe)
                ->get();

                return response($encabezado);
            }
      

            
        } catch (Throwable $e) {
            report($e);
     
            return false;
        }
    }

    public function actualizarencabe(Request $request)
    {
        $encabezadofacturaC = encabezado_factura::findOrFail($request->encabezado);
        $encabezadofacturaC->id_cliente = $request->cliente;
        $encabezadofacturaC->fecha =$request->fecha;
        $encabezadofacturaC->save();
    }

    public function eliminarpedido(Request $request)
    {
    
        $detallef = DB::table('detalle_factura as df')
        ->where('id_encabezadof','=',$request->encabezado)
        ->get();

        $encabezadofacturaC = encabezado_factura::findOrFail($request->encabezado);
        $encabezadofacturaC->status ='0';
        $encabezadofacturaC->save();

        foreach($detallef as $detallef => $valor){

            $productoretorno = Producto::findOrFail($valor->id_producto);
            $productoretorno->cantidad = ($productoretorno->cantidad) + $valor->cantidad;
            $productoretorno->save();

        }
        //dd($detallef);

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

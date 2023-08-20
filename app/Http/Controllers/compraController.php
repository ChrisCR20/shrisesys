<?php

namespace App\Http\Controllers;

use App\Models\detalle_facturaC;
use App\Models\encabezado_facturaC;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\TipoPago;
use Illuminate\Http\Request;
use Illuminate\View\ViewServiceProvider;
use Throwable;
use Carbon\Carbon;

use DB;

class compraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        
        $producto=DB::table('producto')->select('id_producto','nombreproducto')
        ->orderby('id_producto','desc')
        ->get();

        $tipopago=DB::table('tipo_pago')->select('id_tipopago','nombretipo')
        ->orderby('id_tipopago','desc')
        ->get();

        $proveedor=DB::table('proveedor')->select('id_proveedor','nombreproveedor')
        ->orderby('id_proveedor','desc')
        ->get();

        if($request->ajax())
        {


            $data = DB::table('encabezado_facturac as ef')
            ->join('proveedor as pr','ef.id_proveedor','=','pr.id_proveedor')
            ->select('ef.id_encabezadofacturac',DB::raw("CONCAT(ef.serie,'-',ef.numerodoctoc) as Factura"),'ef.fecha','pr.nombreproveedor','ef.totalcompra')
            ->orderBy('ef.id_encabezadofacturac','desc')
            ->get();
            
            //dd($data);
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
                 $btn = '<a class="btn  btn-md" style="color:#C8A60A" title="Editar" href="editcompras/'.$row['id_encabezadofacturac'].'"  class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></a>';

               // $btn = '<button type="button" onClick="editar('.$row['id_sede'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';
                return $btn;
             
             })->rawColumns(['action'])->make(true);
        }
        
        return View('compra.index',['proveedor'=>$proveedor,'tipopago'=>$tipopago,'producto'=>$producto]);


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
        //
   
        //dd($request);
        $miArrayPA = $request->nmtitulo;
        // dd($miArrayPA);
        $facturaC = new encabezado_facturaC;
        $facturaC->fecha =Carbon::createFromFormat('d/m/Y',$request->input('fechafactc')); 
        $facturaC->id_proveedor = $request->input('id_proveedor');
        $facturaC->id_tipopago = $request->input('id_tipopago');
        $facturaC->serie = $request->input('serie');
        $facturaC->numerodoctoc = $request->input('numerodoctoc');
        $facturaC->save();

        $cont =0;
        if ($miArrayPA > 0)
        {
            while($cont < count($request->nmtitulo))
            {
        $detallefacturaC = new detalle_facturaC;
        $detallefacturaC->id_encabezadofacturaC =$facturaC->id_encabezadofacturaC;
        $detallefacturaC->id_producto = $request->tpgrado[$cont];
        $detallefacturaC->subtotal =$request->nmtitulo[$cont];
        $detallefacturaC->cantidad =$request->nminstituto[$cont];
        $detallefacturaC->save();
        $cont=$cont + 1;
            }}

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

        $tipopago = DB::table('tipo_pago')->select('id_tipopago', 'nombretipo')
        ->orderby('id_tipopago', 'desc')
        ->get();

        $proveedor = DB::table('proveedor')->select('id_proveedor', 'nombreproveedor')
        ->orderby('id_proveedor', 'desc')
        ->get();

        $data = DB::table('encabezado_facturac as ef')
        ->select('ef.id_encabezadofacturac', 'ef.serie', 'ef.numerodoctoc', 'ef.id_tipopago', 'ef.id_proveedor', 'ef.totalcompra')
        ->where('ef.id_encabezadofacturaC', '=', $id)
        ->get();

        


        if($request->ajax())
        {
            

            $data1 = DB::table('encabezado_facturac as ef')
            ->join('detalle_facturac as df','ef.id_encabezadofacturac','=','df.id_encabezadofacturac')
            ->join('producto as pr','df.id_producto','=','pr.id_producto')
            ->select('df.id_detallefacturac','df.cantidad','pr.nombreproducto','df.subtotal','ef.id_tipopago','ef.id_proveedor')
            ->where('ef.id_encabezadofacturaC','=',$id)
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
                 $btn = '<a class="btn  btn-md" style="color:#C8A60A" title="Editar" onClick="editarc('.$row['id_detallefacturac'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></a>';

               // $btn = '<button type="button" onClick="editar('.$row['id_sede'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';
                return $btn;
             
             })->rawColumns(['action'])->make(true);
        }

        if(count($data) ==0){
            $etapas=[];
        }else{
        foreach($data as $data => $valor){
            $etapas[] = (array)$valor;
        }}

        //dd($etapas);
        return view('compra.edit',['proveedor'=>$proveedor,'tipopago'=>$tipopago,'etapas'=>$etapas]);
    }
    public function mostraritem($id)
    {
        $item = DB::table('detalle_facturac as df')
        ->join('producto as pr', 'df.id_producto', '=', 'pr.id_producto')
        ->select('pr.nombreproducto', 'df.cantidad', 'df.subtotal', 'df.id_producto', 'df.id_detallefacturac', 'df.id_encabezadofacturaC')
        ->where('id_detallefacturac', '=', $id)
        ->get();

        return response()->json($item);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actu(Request $request)
    {
        try {

            $stockanterior = DB::table('detalle_facturac as dfc')
            ->where('id_detallefacturac','=',$request->iddetallec)
            ->get();
   
            if($request->cantidad > $stockanterior[0]->cantidad)
            {
                $cantidadreal=($request->cantidad) - ($stockanterior[0]->cantidad);

                $productoupdate = Producto::findOrFail($request->iditem);
                $productoupdate->cantidad = ($productoupdate->cantidad) + $cantidadreal;
                $productoupdate->save();
              //  dd($cantidadreal);
            }
            else{
                $cantidadreal=($stockanterior[0]->cantidad)-($request->cantidad);

                $productoupdate = Producto::findOrFail($request->iditem);
                $productoupdate->cantidad = ($productoupdate->cantidad) - $cantidadreal;
                $productoupdate->save();
                //dd($cantidadreal);
            }

        //dd($stockanterior);
            // Validate the value...
            $detallefacturaC = detalle_facturaC::findOrFail($request->iddetallec);
            $detallefacturaC->id_producto = $request->iditem;
            $detallefacturaC->subtotal =$request->subtotal;
            $detallefacturaC->cantidad =$request->cantidad;
            $detallefacturaC->save();


            $encabezado = DB::table('encabezado_facturac as efc')
            ->where('id_encabezadofacturac','=',$request->idencabe)
            ->get();
            
            return response($encabezado);
            
        } catch (Throwable $e) {
            report($e);
     
            return false;
        }
        //dd($request->cantidad,$request->subtotal);
    
        //dd('chile');
    }
    public function actualizarencabe(Request $request)
    {
        $encabezadofacturaC = encabezado_facturaC::findOrFail($request->encabezado);
        $encabezadofacturaC->id_proveedor = $request->proveedor;
        $encabezadofacturaC->totalcompra =$request->total;
        $encabezadofacturaC->id_tipopago =$request->tippago;
        $encabezadofacturaC->serie =$request->serie;
        $encabezadofacturaC->numerodoctoc =$request->numero;
        $encabezadofacturaC->fecha =$request->fecha;
        $encabezadofacturaC->save();
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

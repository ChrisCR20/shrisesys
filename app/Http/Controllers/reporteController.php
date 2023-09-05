<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use PDF;

class reporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *

     */
    public function index(Request $request)
    {

        
        return View('Reporte.index');

    }
    public function bajaexistencia(Request $request){
        $sucursalemp= DB::table('empleado as e')
        ->join('sucursal_empleado as se','se.id_persona','=','e.id_empleado')
        ->select('se.id_sucursal')
        ->where('e.id_empleado','=',auth()->user()->id_empleado)
        ->get();

        $productos = DB::table('producto')
        ->join('marca','marca.id_marca','=','producto.id_marca')
        ->join('categoría','categoría.id_categoria','=','producto.id_categoria')
        ->join('medida','medida.id_medida','=','producto.id_medida')
        ->select('producto.codigoproducto','producto.nombreproducto','producto.cantidad','marca.nombremarca','categoría.nombrecategoria','medida.nombremedida')
        ->where('producto.id_sucursal','=',$sucursalemp[0]->id_sucursal)
        ->whereIn('producto.cantidad',['0','1','2'])
        ->orderby('producto.cantidad','asc')
        ->get();
        

        //dd($productos);

            $pdf = PDF::loadView('Reporte.inventario.bajaexistencia',compact('productos'));
            $path = public_path('facturas');
            $fileName =  time().'.'. 'pdf' ;
            $pdf->save($path . '/' . $fileName);
    
            $pdf = public_path('facturas/'.$fileName);
            return response()->download($pdf)->deleteFileAfterSend(true);
    }
    public function masvendido(Request $request){

        $sucursalemp= DB::table('empleado as e')
        ->join('sucursal_empleado as se','se.id_persona','=','e.id_empleado')
        ->select('se.id_sucursal')
        ->where('e.id_empleado','=',auth()->user()->id_empleado)
        ->get();


        $ventas = DB::table('encabezado_factura')
        ->join('detalle_factura','detalle_factura.id_encabezadof','=','encabezado_factura.id_encabezadof')
        ->join('producto','detalle_factura.id_producto','=','producto.id_producto')
        ->join('caja','caja.id_caja','=','encabezado_factura.id_caja')
        ->select('producto.codigoproducto','producto.nombreproducto',DB::raw('count(detalle_factura.cantidad) as cantidad'))
        ->where('caja.id_sucursal','=',$sucursalemp[0]->id_sucursal)
        ->groupBy('producto.nombreproducto')
        ->orderBy('cantidad','desc')
        ->limit(15)
        ->get();

        
        $pdf = PDF::loadView('Reporte.inventario.masvendido',compact('ventas'));
        $path = public_path('facturas');
        $fileName =  time().'.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);

        $pdf = public_path('facturas/'.$fileName);
        return response()->download($pdf)->deleteFileAfterSend(true);
    }
    public function indexproducto(Request $request)
    {
            $sucursalemp= DB::table('empleado as e')
            ->join('sucursal_empleado as se','se.id_persona','=','e.id_empleado')
            ->select('se.id_sucursal')
            ->where('e.id_empleado','=',auth()->user()->id_empleado)
            ->get();

            $productos = DB::table('producto')
            ->join('marca','marca.id_marca','=','producto.id_marca')
            ->join('categoría','categoría.id_categoria','=','producto.id_categoria')
            ->join('medida','medida.id_medida','=','producto.id_medida')
            ->select('producto.codigoproducto','producto.nombreproducto','producto.cantidad','marca.nombremarca','categoría.nombrecategoria','medida.nombremedida')
            ->where('producto.id_sucursal','=',$sucursalemp[0]->id_sucursal)
            ->orderby('producto.cantidad','asc')
            ->get();
            

          //  dd($productos);

                $pdf = PDF::loadView('Reporte.inventario.productos',compact('productos'));
                $path = public_path('facturas');
                $fileName =  time().'.'. 'pdf' ;
                $pdf->save($path . '/' . $fileName);
        
                $pdf = public_path('facturas/'.$fileName);
                return response()->download($pdf);


    }

    public function indexventas($fechai,$fechaf)
    {
             $sucursalemp= DB::table('empleado as e')
            ->join('sucursal_empleado as se','se.id_persona','=','e.id_empleado')
            ->select('se.id_sucursal')
            ->where('e.id_empleado','=',auth()->user()->id_empleado)
            ->get();

            $ventas = DB::table('encabezado_factura')
            ->join('detalle_factura','detalle_factura.id_encabezadof','=','encabezado_factura.id_encabezadof')
            ->join('cliente','cliente.id_cliente','=','encabezado_factura.id_cliente')
            ->join('producto','detalle_factura.id_producto','=','producto.id_producto')
            ->join('caja','caja.id_caja','=','encabezado_factura.id_caja')
            ->select('encabezado_factura.id_encabezadof','cliente.nombrecliente','encabezado_factura.montototal','producto.nombreproducto',DB::raw('producto.precio_costo * detalle_factura.cantidad as costo'),
            'detalle_factura.cantidad','detalle_factura.subtotal',DB::raw('detalle_factura.subtotal-(producto.precio_costo *detalle_factura.cantidad) as ganancia'),)
            ->where('caja.id_sucursal','=',$sucursalemp[0]->id_sucursal)
            ->whereBetween('encabezado_factura.fecha',[$fechai,$fechaf])
            ->orderby('encabezado_factura.id_encabezadof','asc')
            ->get();
       
            $totales = DB::table('encabezado_factura')
            ->join('detalle_factura','detalle_factura.id_encabezadof','=','encabezado_factura.id_encabezadof')
            ->join('cliente','cliente.id_cliente','=','encabezado_factura.id_cliente')
            ->join('producto','detalle_factura.id_producto','=','producto.id_producto')
            ->join('caja','caja.id_caja','=','encabezado_factura.id_caja')
            ->select(DB::raw('sum(producto.precio_costo * detalle_factura.cantidad) as tcosto'),
            DB::raw('sum(detalle_factura.cantidad) as tcantidad'),DB::raw('sum(detalle_factura.subtotal) as tsubtotal'),DB::raw('sum(detalle_factura.subtotal-(producto.precio_costo *detalle_factura.cantidad)) as tganancia'),)
            ->where('caja.id_sucursal','=',$sucursalemp[0]->id_sucursal)
            ->whereBetween('encabezado_factura.fecha',[$fechai,$fechaf])
            ->orderby('encabezado_factura.id_encabezadof','asc')
            ->get();


          // dd($totales);

                $pdf = PDF::loadView('Reporte.inventario.ventas',compact('ventas','totales'));

                $path = public_path('facturas');
        $fileName =  time().'.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);

        $pdf = public_path('facturas/'.$fileName);
        return response()->download($pdf)->deleteFileAfterSend(true);
                //return response()->$pdf->download('ventas.pdf');
        
    
          //  return view('Reporte.inventario.ventas',compact('ventas'));

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ventasController extends Controller
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
    public function create()
    {
        //
        $tipopago = DB::table('Tipo_pago')
        ->select('id_tipopago','nombretipo')
        ->get();

        $producto=DB::table('Producto')->select('id_producto','nombreproducto')
        ->orderby('id_producto','desc')
        ->get();
        return view('venta.create',['tipopago'=>$tipopago,'producto'=>$producto]);
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
        dd($request->all());
        $miArrayPA = $request->nmtitulo;
        // dd($miArrayPA);
        $facturaC = new encabezado_factura;
        $facturaC->id_cliente = $request->input('id_cliente');
        $facturaC->id_tipopago = $request->input('id_tipopago');
        $facturaC->id_sucursal = $request->input('id_sucursal');
        $facturaC->id_caja = 3;
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

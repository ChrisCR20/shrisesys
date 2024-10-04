<?php

namespace App\Http\Controllers;

use App\Models\asigna_precio;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class clientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *

     */
    public function index(Request $request)
    {


        if($request->ajax())
        {      
            $data = DB::table('cliente')->get();
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
                 $btn = '<a class="btn  btn-md" style="color:#C8A60A" title="Editar"  onClick="editar('.$row['id_cliente'].');" ><div><i class="fa fa-edit"></i></div></a>';
                
               // $btn = '<button type="button" onClick="editar('.$row['id_sede'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';
                return $btn;
             
             }) ->addColumn('asignaprecio',function ($row){
                $btn1 = '<a type="button" title="Asignar precio" href="indexasignaprecio/'.$row['id_cliente'].'" class=" btn btn-primary btn-sm"><div><i class="fa fa-usd"></i></div></a>';

                //$btn1 ='<button type="button" onClick="eliminar('.$row['id_cedecentral'].','.$row['id_status'].');" class="delete btn btn-info btn-sm"><div><i class="fa fa-retweet"></i></div></button>';
                return $btn1;
             })->rawColumns(['action','asignaprecio'])->make(true);
        }
        
        return View('cliente.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
              
        return view('cliente.create');
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
        $Cliente = new Cliente;
        $Cliente->nombrecliente =$request->input('nombre');
        $Cliente->telefonocliente =$request->input('telefono');
        $Cliente->emailcliente =$request->input('email');
        $Cliente->nitcliente =$request->input('nit');
        $Cliente->direccioncliente =$request->input('direccion');
        $Cliente->save();


        return redirect()->route('clientes.index')
            ->with('success', 'Cliente creado satisfactoriamente.');
    }
    public function mostrarcliente($id)
    {
        $cliente = DB::table('cliente')
        ->where('id_cliente','=',$id)
        ->get();
        
        return response()->json($cliente);
    }

    public function storecl(Request $request)
    {
        //
      //dd($request->input('nombrecliente'));

//       $mytime = Carbon::now();
// dd(Carbon::parse($mytime)->setTimezone('America/Guatemala')->format('Y-m-d'));

        $cliente = new Cliente;
        $cliente->nombrecliente =$request->input('nombrecliente');
        $cliente->nitcliente    =$request->input('identificacion');

        $cliente->save();

    
        return response()->json($cliente);
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
    public function edit(Request $request)
    {
        //
        $Cliente = Cliente::findOrFail($request->id_cliente);
        $Cliente->nombrecliente =$request->input('nombreedit');
        $Cliente->telefonocliente =$request->input('telefonoedit');
        $Cliente->emailcliente =$request->input('emailedit');
        $Cliente->nitcliente =$request->input('nitedit');
        $Cliente->direccioncliente =$request->input('direccionedit');
        $Cliente->save();
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

    public function asignaprecioindex(Request $request,$id){

        if($request->ajax())
        {
        $data1 = DB::table('presentacion_cliente as pc')
        ->join('cliente as c','pc.id_cliente','=','c.id_cliente')
        ->join('medida as m','pc.id_presentacion','=','m.id_medida')
        ->select('c.id_cliente','c.nombrecliente','m.id_medida','m.nombremedida','pc.precio','pc.id_prcl')
        ->where('c.id_cliente','=',$id)
        ->get();
        
     //   $datos = json_decode($data,true);
        //dd($data1);
        //dd(Arr::get($data,'idsedecentral'));
        if(count($data1) ==0){
            $etapas1=[["precio"=>"","nombremedida"=>"","id_cliente"=>"","id_prcl"=>""]];
        }else{
        foreach($data1 as $data1 => $valor){
            $etapas1[] = (array)$valor;
        }}
        //dd($etapas1);

        return datatables()->of($etapas1)->addColumn('action',function ($row){
            $btn = '<a class="btn  btn-md" style="color:#C8A60A" title="Editar"  onClick="editar('.$row['id_prcl'].');" ><div><i class="fa fa-edit"></i></div></a>';
           
          // $btn = '<button type="button" onClick="editar('.$row['id_sede'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';
           return $btn;
        
        })->rawColumns(['action'])->make(true);
        }

        $cliente = DB::table('cliente')->where('id_cliente','=',$id)->get();
        $medida = DB::table('medida')->get();
        
     //   $datos = json_decode($data,true);
        //dd($data1);
        //dd(Arr::get($data,'idsedecentral'));
        if(count($cliente) ==0){
            //dd($cliente);
            $etapas1=$cliente;
        }else{
        foreach($cliente as $data1 => $valor){
            $etapas1[] = (array)$valor;
        }}
        return view('cliente.asignaprecio',['etapas1'=> $etapas1,'cliente'=>$cliente,'medida'=>$medida]);
    }

    public function asignarpr(Request $request){
        $asignapr = new asigna_precio();
        $asignapr->id_cliente =$request->input('id_cliente');
        $asignapr->id_presentacion    =$request->input('id_medida');
        $asignapr->precio    =$request->input('precio');

        $asignapr->save();

    
        return response()->json($asignapr);

    }

    public function mostraritem($id)
    {
        $item = DB::table('presentacion_cliente as pc')
        ->join('medida as pr', 'pc.id_presentacion', '=', 'pr.id_medida')
        ->select('pc.id_prcl','pr.nombremedida', 'pc.precio', 'pc.id_cliente')
        ->where('pc.id_prcl', '=', $id)
        ->get();

        return response()->json($item);
    }

    public function actu(Request $request)
    {
        //dd($request);
        try {

                $productoupdate = asigna_precio::findOrFail($request->iditem);
                $productoupdate->precio = $request->precio;
                $productoupdate->save();


            
                return true;
            
        } catch (Throwable $e) {
            report($e);
     
            return false;
        }
        //dd($request->cantidad,$request->subtotal);
    
        //dd('chile');
    }


}

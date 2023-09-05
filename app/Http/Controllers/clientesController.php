<?php

namespace App\Http\Controllers;

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
             
             })->rawColumns(['action'])->make(true);
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
}

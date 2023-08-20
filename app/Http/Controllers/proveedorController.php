<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

use DB;
class proveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {      
            $data = DB::table('proveedor')->get();
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
                 $btn = '<a class="btn  btn-md" style="color:#C8A60A" title="Editar"  onClick="editar('.$row['id_proveedor'].');" ><div><i class="fa fa-edit"></i></div></a>';

               // $btn = '<button type="button" onClick="editar('.$row['id_sede'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';
                return $btn;
             
             })->rawColumns(['action'])->make(true);
        }
        
        return View('proveedor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
              
       return view('proveedor.create');
     
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
        $Proveedor = new Proveedor;
        $Proveedor->nombreproveedor =$request->input('nombre');
        $Proveedor->direccionproveedor =$request->input('direccion');
        $Proveedor->nitproveedor =$request->input('nit');
        $Proveedor->save();

    }
    public function mostrarproveedor($id)
    {
        $proveedor = DB::table('proveedor')
        ->where('id_proveedor','=',$id)
        ->get();
        
        return response()->json($proveedor);
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
        $Proveedor = Proveedor::findOrFail($request->id_proveedor);
        $Proveedor->nombreproveedor =$request->input('nombreedit');
        $Proveedor->direccionproveedor =$request->input('direccionedit');
        $Proveedor->nitproveedor =$request->input('nitedit');
        $Proveedor->save();
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

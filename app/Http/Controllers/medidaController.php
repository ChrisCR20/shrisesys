<?php

namespace App\Http\Controllers;

use App\Models\asignap_costo;
use App\Models\Medida;
use Illuminate\Http\Request;

use DB;
class medidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
             //
             $data = DB::table('medida')
             ->select('id_medida','nombremedida')
             ->get();
         
             if(count($data) ==0){
                 $etapas=[];
             }else{
             foreach($data as $data => $valor){
                 $etapas[] = (array)$valor;
             }}
                 //  dd($etapas);
             return view('medida.index',['etapas'=>$etapas]);
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
        $medida = new Medida;
        $medida->nombremedida =$request->input('nombremedida');

        $medida->save();


        // return redirect()->route('medida.index')
        //     ->with('success', 'Medida creada satisfactoriamente.');
    }

    public function obtenermedida(Request $request)
    {
        $search = $request->search;

        if($search=='')
        {
            $medida = DB::table('medida')
            ->select('id_medida','nombremedida')
            ->get();
            // dd($categorias);
        }else
        {
            $medida = DB::table('medida')
            ->select('id_medida','nombremedida')
            ->where('nombremedida','like','%'.$search.'%')
            ->get();

        }
        $response = array();
        foreach($medida as $data => $valor){
            $response[] = (array)$valor;
        }
        return response()->json($response);
    }

    public function asignapreciocosto(Request $request)
    {
        if($request->ajax())
        {
        $data1 = DB::table('presentacion_costo as pc')
        ->join('medida as m','pc.id_medida','=','m.id_medida')
        ->select('m.id_medida','m.nombremedida','pc.precio_costo','pc.id')
        ->get();
        
     //   $datos = json_decode($data,true);
        //dd($data1);
        //dd(Arr::get($data,'idsedecentral'));
        if(count($data1) ==0){
            $etapas1=[["precio_costo"=>"","nombremedida"=>"","id"=>""]];
        }else{
        foreach($data1 as $data1 => $valor){
            $etapas1[] = (array)$valor;
        }}
        //dd($etapas1);

        return datatables()->of($etapas1)->addColumn('action',function ($row){
            $btn = '<a class="btn  btn-md" style="color:#C8A60A" title="Editar"  onClick="editar('.$row['id'].');" ><div><i class="fa fa-edit"></i></div></a>';
           
          // $btn = '<button type="button" onClick="editar('.$row['id_sede'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';
           return $btn;
        
        })->rawColumns(['action'])->make(true);
        }
        $medida = DB::table('medida')->get();

        return view('medida.asignapreciocosto',['medida'=> $medida]);
    }

    public function asignarpr(Request $request){
        $asignapr = new asignap_costo();
        $asignapr->id_medida    =$request->input('id_medida');
        $asignapr->precio_costo    =$request->input('precio');

        $asignapr->save();

    
        return response()->json($asignapr);

    }
    public function mostraritem($id)
    {
        $item = DB::table('presentacion_costo as pc')
        ->join('medida as pr', 'pc.id_medida', '=', 'pr.id_medida')
        ->select('pc.id','pr.nombremedida', 'pc.precio_costo')
        ->where('pc.id', '=', $id)
        ->get();

        return response()->json($item);
    }
    public function actu(Request $request)
    {
        //dd($request);
        try {

                $productoupdate = asignap_costo::findOrFail($request->iditem);
                $productoupdate->precio_costo = $request->precio;
                $productoupdate->save();


            
                return true;
            
        } catch (Throwable $e) {
            report($e);
     
            return false;
        }
        //dd($request->cantidad,$request->subtotal);
    
        //dd('chile');
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

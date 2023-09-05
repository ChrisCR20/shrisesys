<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Sucursal;
use Illuminate\Http\Request;

use DB;

class sucursalController extends Controller
{
    //
    public function create()
    {
        $empresa=Empresa::pluck('nombre_empresa','id_empresa');

  //  return view('auth.register',compact('roles') );
       

        return view('sucursal.create',compact('empresa'));
    }

    public function index(Request $request)
    {
      
       // $data = Empresa::orderBy('id_empresa', 'desc');
       //$empresa=Empresa::pluck('nombre_empresa','id_empresa');
       $empresa=DB::table('empresa')->select('id_empresa','nombre_empresa')->get();
       if($request->ajax())
       {
           $data = DB::table('sucursal')
           ->join('empresa','sucursal.id_empresa','=','empresa.id_empresa')
           ->select('sucursal.id_sucursal','sucursal.nombresucursal','sucursal.direccionsucursal','empresa.nombre_empresa')
           ->where('sucursal.status','=','1')
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
                $btn = '<a class="btn  btn-md" style="color:#C8A60A" title="Editar"  onClick="editar('.$row['id_sucursal'].');" ><div><i class="fa fa-edit"></i></div></a>';

              // $btn = '<button type="button" onClick="editar('.$row['id_sede'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';
               return $btn;
            
            })->rawColumns(['action'])->make(true);
       }
       
            //dd($empresa);
        return view('sucursal.index',['empresa'=>$empresa]);
      
    }

    public function store(Request $request)
    {
    
        $sucursal = new Sucursal;
        $sucursal->nombresucursal = $request->input('nombre_sucursal');
        $sucursal->direccionsucursal = $request->input('direccion');
        $sucursal->id_empresa = $request->input('id_empresac');
        $sucursal->status = '1';
        $sucursal->save();

        // return redirect()->route('sucursal.index')
        //     ->with('success', 'Sucursal creada satisfactoriamente.');
    }
    public function mostrarsucursal($id)
    {
        $sucursal = DB::table('sucursal')
        ->select('id_sucursal','nombresucursal','direccionsucursal','id_empresa')
        ->where('id_sucursal','=',$id)
        ->get();
        
        return response()->json($sucursal);
    }

    public function edit(Request $request)
    {
        
        $sucursal = Sucursal::findOrFail($request->id_sucursal);
        $sucursal->nombresucursal = $request->nombre_sucursaledit;
        $sucursal->direccionsucursal = $request->direccionedit;
        $sucursal->id_empresa = $request->id_empresa;
        $sucursal->save();
   
    }

    public function show()
    {
   
    }
}

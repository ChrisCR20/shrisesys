<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

use DB;
class empresaController extends Controller
{
    //
    public function create()
    {
       

        return view('empresa.create');
    }

    public function index(Request $request)
    {
       // $data = Empresa::orderBy('id_empresa', 'desc');

       if($request->ajax())
        {
            $data = DB::table('empresa')
            ->select('id_empresa','nombre_empresa','descripcion')
            ->where('status','=','1')
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
                 $btn = '<a class="btn  btn-md" style="color:#C8A60A" title="Editar"  onClick="editar('.$row['id_empresa'].');" ><div><i class="fa fa-edit"></i></div></a>';

               // $btn = '<button type="button" onClick="editar('.$row['id_sede'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';
                return $btn;
             
             })->rawColumns(['action'])->make(true);
        }
        
        return View('empresa.index');

      
    }

    public function store(Request $request)
    {
      //  dd("PO");
        $empresa = new Empresa;
        $empresa->nombre_empresa = $request->input('nombre_empresa');
        $empresa->descripcion = $request->input('descripcion');
        $empresa->save();

        // return redirect()->route('empresa.index')
        //     ->with('success', 'Empresa creada satisfactoriamente.');
    }

    public function mostrarempesa($id)
    {
        $empresa = DB::table('empresa')
        ->select('id_empresa','nombre_empresa','descripcion')
        ->where('id_empresa','=',$id)
        ->get();
        
        return response()->json($empresa);
    }

    public function edit(Request $request)
    {
        $empresa = Empresa::findOrFail($request->id_empresa);
        $empresa->nombre_empresa = $request->nombreedit;
        $empresa->descripcion = $request->descripedit;
        $empresa->save();
   
    }
}

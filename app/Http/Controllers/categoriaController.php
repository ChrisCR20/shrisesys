<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

use DB;
class categoriaController extends Controller
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
            $data = DB::table('categoría')
            ->select('id_categoria','nombrecategoria')
            ->get();;
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
                 $btn = '<button type="button" onClick="editar('.$row['id_categoria'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';

               // $btn = '<button type="button" onClick="editar('.$row['id_sede'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';
                return $btn;
             
             })->rawColumns(['action'])->make(true);
        }
        
        return View('categoria.index');
        //
        // $data = DB::table('Categoría')
        // ->select('id_categoria','nombrecategoria')
        // ->get();
    
        // if(count($data) ==0){
        //     $etapas=[];
        // }else{
        // foreach($data as $data => $valor){
        //     $etapas[] = (array)$valor;
        // }}
        //     //  dd($etapas);
        // return view('categoria.index',['etapas'=>$etapas]);
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
                //
                $categoria = new Categoria;
                $categoria->nombrecategoria =$request->input('nombrecategoria');
    
                $categoria->save();
        
        
                // return redirect()->route('categoria.index')
                //     ->with('success', 'Cliente creado satisfactoriamente.');
    }
    public function obtenercategoria(Request $request)
    {
        $search = $request->search;

        if($search=='')
        {
            $categorias = DB::table('categoría')
            ->select('id_categoria','nombrecategoria')
            ->get();
            // dd($categorias);
        }else
        {
            $categorias = DB::table('categoría')
            ->select('id_categoria','nombrecategoria')
            ->where('nombrecategoria','like','%'.$search.'%')
            ->get();

        }
        $response = array();
        foreach($categorias as $data => $valor){
            $response[] = (array)$valor;
        }
        return response()->json($response);
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

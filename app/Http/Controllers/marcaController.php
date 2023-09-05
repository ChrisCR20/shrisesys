<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

use DB;
class marcaController extends Controller
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
              $data = DB::table('marca')
              ->select('id_marca','nombremarca')
              ->get();
          
              if(count($data) ==0){
                  $etapas=[];
              }else{
              foreach($data as $data => $valor){
                  $etapas[] = (array)$valor;
              }}
                  //  dd($etapas);
              return view('marca.index',['etapas'=>$etapas]);
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
        $marca = new Marca;
        $marca->nombremarca =$request->input('nombremarca');

        $marca->save();


        // return redirect()->route('marca.index')
        //     ->with('success', 'Marca creada satisfactoriamente.');
    }

    public function obtenermarca(Request $request)
    {
        $search = $request->search;

        if($search=='')
        {
            $marca = DB::table('marca')
            ->select('id_marca','nombremarca')
            ->get();
            // dd($categorias);
        }else
        {
            $marca = DB::table('marca')
            ->select('id_marca','nombremarca')
            ->where('nombremarca','like','%'.$search.'%')
            ->get();

        }
        $response = array();
        foreach($marca as $data => $valor){
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

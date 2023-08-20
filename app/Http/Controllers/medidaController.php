<?php

namespace App\Http\Controllers;

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

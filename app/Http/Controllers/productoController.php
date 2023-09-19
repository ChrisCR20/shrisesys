<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Medida;
use App\Models\Producto;
use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Auth;

class productoController extends Controller
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
            $data = DB::table('producto as p')
            ->join('marca as m','p.id_marca','=','m.id_marca')
            ->join('categoría as cat','p.id_categoria','=','cat.id_categoria')
            ->join('medida as med','p.id_medida','=','med.id_medida')
            ->join('sucursal as su','su.id_sucursal','=','p.id_sucursal')
            ->join('sucursal_empleado as se','se.id_sucursal','=','su.id_sucursal')
            ->where('se.id_persona','=',Auth::user()->id_empleado)
            ->select('p.codigoproducto','p.nombreproducto','p.cantidad','cat.nombrecategoria','m.nombremarca','med.nombremedida','p.id_producto')
            ->get();
    
            if(count($data) ==0){
                $etapas=[];
            }else{
            foreach($data as $data => $valor){
                $etapas[] = (array)$valor;
            }}
     

             return datatables()->of($etapas)->addColumn('action',function ($row){
                 $btn = '<a class="btn  btn-md" style="color:#A60A" title="Editar"  href="'.route('producto.edit',$row['id_producto']).'" ><div><i class="fa fa-edit"></i></div></a>';

               // $btn = '<button type="button" onClick="editar('.$row['id_sede'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';
                return $btn;
             
             })->rawColumns(['action'])->make(true);
        }

        return view('producto.index');
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $categoria=Categoria::pluck('nombrecategoria','id_categoria');

        
        $marca=Marca::pluck('nombremarca','id_marca');

        
        $medida=Medida::pluck('nombremedida','id_medida');

        return view('producto.create',compact('categoria','marca','medida'));
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
        $sucursalemp= DB::table('empleado as e')
        ->join('sucursal_empleado as se','se.id_persona','=','e.id_empleado')
        ->select('se.id_sucursal')
        ->where('e.id_empleado','=',auth()->user()->id_empleado)
        ->get();

       

        $Producto = new Producto;
        $Producto->id_marca = $request->input('id_marca');
        $Producto->id_categoria = $request->input('id_categoria');
        $Producto->id_medida = $request->input('id_medida');
        $Producto->nombreproducto = $request->input('nombreproducto');
        $Producto->codigoproducto = $request->input('codigoproducto');
        $Producto->codigobarras = $request->input('codigobarras');
        $Producto->precio_costo = $request->input('precio_costo');
        $Producto->precio_venta = $request->input('precio_venta');
        $Producto->id_sucursal = $sucursalemp[0]->id_sucursal;
        $Producto->id_usuario = Auth::user()->id;
        $Producto->save();

        return redirect()->route('producto.index')
        ->with('success', 'Producto creado satisfactoriamente.');

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
      
        $categoria=Categoria::pluck('nombrecategoria','id_categoria');

        
        $marca=Marca::pluck('nombremarca','id_marca');

        
        $medida=Medida::pluck('nombremedida','id_medida');

        $data = DB::table('producto')
        ->join('categoría','producto.id_categoria','=','categoría.id_categoria')
        ->join('marca','producto.id_marca','=','marca.id_marca')
        ->join('medida','producto.id_medida','=','medida.id_medida')
        ->where('producto.id_producto','=',$id)
        ->get();
    


        return view('producto.edit',compact('categoria','marca','medida','data'));
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
        $input = $request->all();
    
        $persona = Producto::find($id);
        //dd($persona);
        $persona->update($input);

        return redirect()->route('producto.index')->with('success', 'Producto actualizado exitosamente.');
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

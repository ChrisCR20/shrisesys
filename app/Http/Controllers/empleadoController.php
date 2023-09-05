<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Empresa;
use App\Models\Persona;
use App\Models\Sucursal;
use App\Models\SucursalEmpleado;
use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Auth;

class empleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursalemp= DB::table('empleado as e')
        ->join('sucursal_empleado as se','se.id_persona','=','e.id_empleado')
        ->select('se.id_sucursal')
        ->where('e.id_empleado','=',auth()->user()->id_empleado)
        ->get();

        $data = DB::table('persona')
        ->join('empleado','empleado.codunicoid','=','persona.codunicoid')
        ->join('sucursal_empleado','sucursal_empleado.id_persona','=','empleado.id_empleado')
        ->join('sucursal','sucursal.id_sucursal','=','sucursal_empleado.id_sucursal')
        ->select('persona.id_persona',DB::raw("CONCAT(persona.primer_nombre,' ',persona.primer_apellido) as nombre"),'persona.codunicoid','sucursal.nombresucursal')
        ->where('sucursal.id_sucursal','=',$sucursalemp[0]->id_sucursal)
        ->get();
    
        if(count($data) ==0){
            $etapas=[];
        }else{
        foreach($data as $data => $valor){
            $etapas[] = (array)$valor;
        }}
            //  dd($etapas);
        return view('empleado.index',['etapas'=>$etapas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sucursalemp= DB::table('empleado as e')
        ->join('sucursal_empleado as se','se.id_persona','=','e.id_empleado')
        ->select('se.id_sucursal')
        ->where('e.id_empleado','=',auth()->user()->id_empleado)
        ->get();

        $sucursal=Sucursal::where('id_sucursal',$sucursalemp[0]->id_sucursal)->pluck('nombresucursal','id_sucursal');
        
        return view('empleado.create',compact('sucursal'));
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
        $Persona = new Persona;
        $Persona->codunicoid = $request->input('codunicoid');
        $Persona->primer_nombre = $request->input('primer_nombre');
        $Persona->segundo_nombre = $request->input('segundo_nombre');
        $Persona->tercer_nombre = $request->input('tercer_nombre');
        $Persona->primer_apellido = $request->input('primer_apellido');
        $Persona->segundo_apellido = $request->input('segundo_apellido');
        $Persona->save();

        $empleado = new Empleado;
        $empleado->codunicoid =$request->input('codunicoid');
        $empleado->tel_corporativo =$request->input('tel_corporativo');
        $empleado->status ='1';
        $empleado->save();

        $empleadoSucursal = new Sucursalempleado;
        $empleadoSucursal->id_persona =$empleado->id_empleado;
        $empleadoSucursal->id_sucursal =$request->input('id_sucursal');
        $empleadoSucursal->save();


        return redirect()->route('empleado.index')
            ->with('success', 'empleado creado satisfactoriamente.');
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
        $data = DB::table('persona')
        ->join('empleado','persona.codunicoid','=','empleado.codunicoid')
        ->where('persona.id_persona','=',$id)
        ->get();
        dd($data);
        return view('empleado.profile',compact('data'));
    }

    public function perfil(){

        $id  = Auth::user()->identificacion;

        $data = DB::table('persona')
        ->join('empleado','persona.codunicoid','=','empleado.codunicoid')
        ->join('sucursal_empleado','empleado.id_empleado','=','sucursal_empleado.id_persona')
        ->join('sucursal','sucursal_empleado.id_sucursal','=','sucursal.id_sucursal')
        ->where('persona.codunicoid','=',$id)
        ->get();
        
        return view('empleado.profile',compact('data'));
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
        $dpi =DB::table('persona')
        ->where('id_persona','=',$id)
        ->pluck('codunicoid');
    
        $empleado =DB::table('empleado')
        ->where('codunicoid','=',$dpi)
        ->pluck('tel_corporativo');

        $data = DB::table('persona')
        ->join('empleado','persona.codunicoid','=','empleado.codunicoid')
        ->join('sucursal_empleado','empleado.id_empleado','=','sucursal_empleado.id_persona')
        ->where('persona.id_persona','=',$id)
        ->get();
        
        //dd($data);
        $persona = Persona::find($id);
        $sucursal = Sucursal::pluck('nombresucursal', 'id_sucursal')->all();

    
        return view('empleado.edit', compact('data', 'sucursal'));
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
        $idemp =DB::table('persona')
        ->join("empleado","empleado.codunicoid","=","persona.codunicoid")
        ->where('id_empleado','=',$id)
        ->pluck('empleado.id_empleado');

        $codunico =DB::table('persona')
        ->join("empleado","empleado.codunicoid","=","persona.codunicoid")
        ->where('id_empleado','=',$id)
        ->pluck('persona.id_persona');

        //dd("ver");
       //dd($idemp[0]);
        $input = $request->all();

        $empleado =empleado::findOrFail($idemp[0]);
        $empleado->tel_corporativo =$request->input('tel_corporativo');
        $empleado->status ='1';
        $empleado->save();
        
        $empleadoSucursal = Sucursalempleado::findOrFail($idemp[0]);
        $empleadoSucursal->id_sucursal = $request->input('id_sucursal');
        $empleadoSucursal->save();
            
        $persona = Persona::find($codunico[0]);
        $persona->update($input);
        


       

        return redirect()->route('empleado.index')->with('success', 'empleado actualizado exitosamente.');

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

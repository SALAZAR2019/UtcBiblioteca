<?php

namespace App\Http\Controllers;

use App\Models\EmpleadoController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ApiEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empleados']=EmpleadoController::paginate(2);
        return view('empleado.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'nombre'=>'required|string|max:200',
            'apellidop'=>'required|string|max:200',
            'apellidom'=>'required|string|max:200',
            'correo'=>'required|email',
            'foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'foto.required'=>'La foto es requerida'
        ];
        $this->validate($request, $campos, $mensaje);

        //$datosEmpleado = request() ->all();
        $datosEmpleado = request()->except('_token');

        if($request->hasFile('foto')) {
            $datosEmpleado['foto']=$request->file('foto')->store('uploads','public');
        }
        EmpleadoController::insert($datosEmpleado);
         //return response()->json($datosEmpleado);
         return redirect('empleado')->with('mensaje','Empleado agregado con éxito');
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
        $empleado=EmpleadoController::findOrFail($id);
        return view('empleado.edit', compact('empleado') );
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
        $campos=[
            'nombre'=>'required|string|max:200',
            'apellidop'=>'required|string|max:200',
            'apellidom'=>'required|string|max:200',
            'correo'=>'required|email',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
        if($request->hasFile('foto')) {
            $campos=[ 'foto'=>'required|max:10000|mimes:jpeg,png,jpg' ];
            $mensaje=[ 'foto.required'=>'La foto es requerida' ];
        }
        
        $this->validate($request, $campos, $mensaje);


        $datosEmpleado= request()->except(['_token','_method']);

        if($request->hasFile('foto')) {
            $empleado=EmpleadoController::findOrFail($id);
            Storage::delete('public/'.$empleado->foto);
            $datosEmpleado['foto']=$request->file('foto')->store('uploads','public');
        }

        EmpleadoController::where('id_e','=',$id)->update($datosEmpleado);

        $empleado=EmpleadoController::findOrFail($id);
        //return view('empleado.edit', compact('empleado') );
        return redirect('empleado')->with('mensaje','Empleado Modificado');
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

        $empleado=EmpleadoController::findOrFail($id);
        if(Storage::delete('public/'.$empleado->foto)){
        EmpleadoController::destroy($id);
        }      
        return redirect('empleado')->with('mensaje','Empleado Borrado');
       
    }
}

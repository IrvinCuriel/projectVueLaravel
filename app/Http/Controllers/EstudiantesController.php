<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Estudiante::all();
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
        $inputs = $request->input();
        $respuesta = Estudiante::create($inputs);
        return response()->json([
            'data'=>$respuesta,
            'mensaje' => 'Estudiante Creado'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estudiante = Estudiante::find($id);
        if(isset($estudiante)){
            return response()->json([
                'data'=>$estudiante,
                'mensaje' => 'Estudiante Encontrado'
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'mensaje' => 'No se encontro a Estudiante'
            ]);
        }
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
        $estudiante = Estudiante::find($id);
        if(isset($estudiante)){
            $estudiante->nombre = $request->nombre;
            $estudiante->apellido = $request->apellido;
            $estudiante->foto = $request->foto;
            if( $estudiante->save() ){
                return response()->json([
                    'data'=>$estudiante,
                    'mensaje' => 'Estudiante Actualizado'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'mensaje' => 'No se pudo actualizar'
                ]);
            }
        }else{
            return response()->json([
                'error'=>true,
                'mensaje' => 'No existe el Estudiante'
            ]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estudiante = Estudiante::find($id);
        if(isset($estudiante)){
            $res = Estudiante::destroy($id);
            if($res){
                return response()->json([
                    'data'=>$estudiante,
                    'mensaje' => 'Estudiante Eliminado'
                ]);                
            }else{
                return response()->json([
                    'data'=>[],
                    'mensaje' => 'No se pudo eliminar Estudiante'
                ]);  
            }
        }else{
            return response()->json([
                'error'=>true,
                'mensaje' => 'Estudiante No existe'
            ]);
        }
    }
}

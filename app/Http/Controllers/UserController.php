<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $inputs["password"] = Hash::make(trim($request->password));
        $respuesta = User::create($inputs);
        return response()->json([
            'data'=>$respuesta,
            'mensaje' => 'Creado con exito'
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
        $estudiante = User::find($id);
        if(isset($estudiante)){
            return response()->json([
                'data'=>$estudiante,
                'mensaje' => 'Encontrado con exito'
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'mensaje' => 'No existe'
            ]);
        }
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
        $estudiante = User::find($id);
        if(isset($estudiante)){
            $estudiante->first_name = $request->first_name;
            $estudiante->last_name = $request->last_name;
            $estudiante->email = $request->email;
            $estudiante->password = Hash::make($request->password);
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
                //test
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
        $estudiante = User::find($id);
        if(isset($estudiante)){
            $res = User::destroy($id);
            if($res){
                return response()->json([
                    'data'=>$estudiante,
                    'mensaje' => 'Eliminado'
                ]);                
            }else{
                return response()->json([
                    'data'=>[],
                    'mensaje' => 'No se pudo eliminar'
                ]);  
            }
        }else{
            return response()->json([
                'error'=>true,
                'mensaje' => 'No existe'
            ]);
        }
    }
}

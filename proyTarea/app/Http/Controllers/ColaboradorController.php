<?php

namespace sisTareas\Http\Controllers;

use sisTareas\Colaborador;
use Illuminate\Http\Request;

use DB;
use Validator;

class ColaboradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function activarPermisosCORS(){
        if (isset($_SERVER['HTTP_ORIGIN'])) {  
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}"
            ,'Access-Control-Allow-Credentials: true'
            ,'Access-Control-Max-Age: 86400');   
        }
    }
    // GET
    public function index()
    {
        $this->activarPermisosCORS();
        $msje = '';
        // -------------------------------------------
        // ELOQUENT LARAVEL
        //  METODOS PROPIOS DE CLASE
        // ALL(); -> TE HACE UN SELECT DE TODOS LOS REGISTROS
        // GET(); -> SELECT (C1,C2)
        // FIRST(); -> SELECT * FROM COLABORADORES LIMIT 1
        // FIND (); -> SELECT * FROM COLABORADORES LIMIT 1
        // --------------------------------------------
        DB::beginTransaction();
        try{
            $colaboradores = Colaborador::all();
        }catch(\Exception $ex){
            $msje = $ex->getMessage();
            DB::rollback();
        }
     
        DB::commit();
     
        return $msje == ''? array('estado' => true, 'cantidad' => count($colaboradores), 'data' => $colaboradores): $msje;
        // dd('Exito');
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
    // POST
    public function store(Request $request)
    {
        //
        $msje = $this->validarCampos($request);
        
        // -------------------------------------------
        // ELOQUENT LARAVEL
        //  METODOS PROPIOS DE CLASE
        // ALL(); -> TE HACE UN SELECT DE TODOS LOS REGISTROS
        // GET(); -> SELECT (C1,C2)
        // FIRST(); -> SELECT * FROM COLABORADORES LIMIT 1
        // FIND (); -> SELECT * FROM COLABORADORES LIMIT 1
        // --------------------------------------------
        if($msje === '' || is_null($msje)){
            DB::beginTransaction();
            try{
                $isValid = Colaborador::where('dni','=',$request->get('dni'))->count();
                if($isValid === 0){
                    $c = new Colaborador;
                    $c->dni = $request->get('dni');
                    $c->nombre = $request->get('nombre');
                    $c->apellidos = $request->get('apellidos');
                    $c->fechaNacimiento = $request->get('fechaNacimiento');
                    $c->save();
                    $msje = 'Exito';
                }else{
                    $msje = 'Dni ya Registrado';
                }
            }catch(\Exception $ex){
                $msje = $ex->getMessage();
                DB::rollback();
            }
        
            DB::commit();
        }

        return $msje;
        // dd('Exito');
        
    }

    public function validarCampos($request){
        $reglas = [
            'dni'=> 'required|min:8|max:8|string',
            'nombre'=> 'required|max:255|string',
            'apellidos'=> 'required|max:255|string',
            'fechaNacimiento'=> 'required'
        ];

        $mensajes = [
            'dni.required'=> 'Indique Dni',
            'dni.min'=> 'Dni debe tener 8 caracteres numericos',
            'dni.max'=> 'Dni debe tener 8 caracteres numericos',
            'nombre.required'=> 'Indique Nombres',
            'nombre.max'=> 'Nombre No debe exceder a 255 caracteres',
            'apellidos.required'=> 'Indique Apellidos',
            'apellidos.max'=> 'Apellidos No debe exceder a 255 caracteres',
            'fechaNacimiento.required'=> 'Indique Fecha de Nacimiento'
        ];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
        $msjeE = '';
        if ($validator->fails()) {
            $messages = $validator->errors();
            $msjeE = $msjeE.''.($messages->first('dni')!=""?$messages->first('dni').', ':'');
            $msjeE = $msjeE.''.($messages->first('nombre')!=""?$messages->first('nombre').', ':'');
            $msjeE = $msjeE.''.($messages->first('apellidos')!=""?$messages->first('apellidos').', ':'');
            $msjeE = $msjeE.''.($messages->first('fechaNacimiento')!=""?$messages->first('fechaNacimiento').', ':'');
            return $msjeE;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \sisTareas\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    // GET
    public function show(Colaborador $colaborador)
    {
        //
        dd('Esto es Show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \sisTareas\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    public function edit($colaborador)
    {
        //
        $c = Colaborador::find($colaborador);
        $textoBoton = 'Actualizar';
        $coloBoton = 'btn-danger';
        $titulo = 'Actualizar Registro';
        // dd($colaborador);
        return view('/formulario', ['colaborador' => $c, 'boton' => $textoBoton, 'color' => $coloBoton, 'titulo' => $titulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \sisTareas\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    // PUT
    public function update(Request $request, $colaborador)
    {
        //
        $msje = $this->validarCampos($request);
        
        // -------------------------------------------
        // ELOQUENT LARAVEL
        //  METODOS PROPIOS DE CLASE
        // ALL(); -> TE HACE UN SELECT DE TODOS LOS REGISTROS
        // GET(); -> SELECT (C1,C2)
        // FIRST(); -> SELECT * FROM COLABORADORES LIMIT 1
        // FIND (); -> SELECT * FROM COLABORADORES LIMIT 1
        // --------------------------------------------
        if($msje === '' || is_null($msje)){
            DB::beginTransaction();
            try{
                $isValid = Colaborador::where('dni','=',$request->get('dni'))->where('id','<>',$colaborador)->count();
                if($isValid === 0){
                    $c = Colaborador::find($colaborador);
                    $c->dni = $request->get('dni');
                    $c->nombre = $request->get('nombre');
                    $c->apellidos = $request->get('apellidos');
                    $c->fechaNacimiento = $request->get('fechaNacimiento');
                    $c->save();
                    $msje = 'Exito';
                }else{
                    $msje = 'Dni ya Registrado';
                }
            }catch(\Exception $ex){
                $msje = $ex->getMessage();
                DB::rollback();
            }
        
            DB::commit();
        }

        return $msje;
        // dd('Exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \sisTareas\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    // DELETE
    public function destroy($colaborador)
    {
        // dd('enlazado');
        // -------------------------------------------
        // ELOQUENT LARAVEL
        //  METODOS PROPIOS DE CLASE
        // ALL(); -> TE HACE UN SELECT DE TODOS LOS REGISTROS
        // GET(); -> SELECT (C1,C2)
        // FIRST(); -> SELECT * FROM COLABORADORES LIMIT 1
        // FIND (); -> SELECT * FROM COLABORADORES LIMIT 1
        // --------------------------------------------
        DB::beginTransaction();
        try{
            $c = Colaborador::find($colaborador);
            if(!is_null($c)){
                $c->delete();
                $msje = 'Exito';
            }else{
                $msje = 'Registro ya antes Eliminado';
            }
        }catch(\Exception $ex){
            $msje = $ex->getMessage();
            DB::rollback();
        }
    
        DB::commit();
    
        return $msje;
    }
}

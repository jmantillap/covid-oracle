<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Entidades\Ciudad;
use App\Entidades\Sedes;
use DB;
use Log;
use Exception;


//Importanto las validaciones
use App\Http\Requests\SaveSedeRequest;


class SedesController extends Controller
{
    
  
  public function __construct(){
    $this->middleware('auth');
   // $this->middleware('role:1|2');
    
}

  
  
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /*
      var_dump(auth()->user()->n_idciudad);
      var_dump(auth()->user()->ciudad->t_nombre);
      var_dump(auth()->user()->n_id);
      var_dump(Auth::id());
*/ 
      
      return view('sedes.index', 
        [
            'sedes'=> Sedes::orderBy('t_sede','ASC')->paginate(10)
        ]);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $ciudades= Ciudad::all();
      //$project = Project::findOrFail($id);
        return view('sedes.create',[
          'sedes' => new Sedes,
          'ciudades'=>$ciudades
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     
     */
    public function store(SaveSedeRequest $request)
    {
      Sedes::create($request->validated()); //solo envia los que esten validados por SaveSedeRequest
      return redirect()->route('sedes.index')->with('status','La Sede fue creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     
     */
    public function show(Sedes $sedes)
    {
      
      return view('sedes.show', [
            'sedes' => $sedes
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     
     */
    
    public function edit(Sedes $sedes)
      {
        $ciudades= Ciudad::all();
        return view('sedes.edit',
        [
          'sedes'=>$sedes,
          'ciudades'=>$ciudades
        ]);
      }

    /**
     * Update the specified resource in storage.
     *
     
     */
    public function update(Sedes $sedes, SaveSedeRequest $request)
      {

       
    $sedes->update($request->validated()); //solo envia los que esten validados por SaveEscuelaRequest
        return redirect()->route('sedes.show',$sedes)->with('status','La Sede fue actualizada con éxito');


      }

    /**
     * Remove the specified resource from storage.
     *
     
     */
    public function destroy(Sedes $sedes)
    {
      try {
        DB::beginTransaction();           
        $sedes->delete();  
        DB::commit();
      } catch (Exception $e) {
        DB::rollBack();
        Log::error($e);            
        return redirect()->route('sedes.index')->with('error','Error: No se puede eliminar consulte al administrador del sistema  ');;        
      }
      
      return redirect()->route('sedes.index')->with('status','La Sede fue eliminada con éxito');;
    }
}

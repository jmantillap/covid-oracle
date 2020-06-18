<?php

namespace App\Http\Controllers\Loginupb;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Entidades\Menus;
use Auth;
use App\Entidades\Sedes;
use App\Entidades\Ciudad;
use App\Entidades\Vinculou;
use DB;


//Importanto las validaciones
use App\Http\Requests\SaveUserRequest;
use App\Http\Requests\SaveUser2Request;
use App\Http\Requests\SaveUserupbRequest;

use Session;


class UsersupbController extends Controller
{
    
  
  public function __construct(){
   // $this->middleware('auth');
   // $this->middleware('role:1|2');
    
}

  
  
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
      
      return view('users.index', 
        [
            'users'=> User::orderBy('t_apellidos','ASC')->paginate(10)
        ]);  
    }

    public function listarSedesAjax($request)
    {
        $sql = "SELECT n_idsede, t_sede FROM sedes 
                 WHERE n_idciudad = :n_idciudad
              ORDER BY t_sede";
        
        $sedes = DB::select($sql, ['n_idciudad' => request('n_idciudad')]);
        return response()->json($sedes);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //$project = Project::findOrFail($id);
      if(Session::has('vs_ussel')){
        $usuario= Session::get('vs_ussel');
      } 
      
      // var_dump($usuario);
      $vinculou= Vinculou::all();
      $ciudades = Ciudad::where('b_habilitado', '=', '1')->orderBY('t_nombre')->get();
      return view('usersupb.create',[
        'users' => new User,
        'ciudades' => $ciudades,
        'vinculous'=>$vinculou,
        'usuario'=>$usuario
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     
     */
    public function store(SaveUserupbRequest $request)
    {
      $resultado=User::create($request->validated())->n_idusuario; //solo envia los que esten validados por CreateUserRequest
      Session::put('idUsuario',$resultado);
      //$resultado=Formulario::create($campos)->n_idformulario;
      return redirect()->route('formularioupb.create')->with('status','¡ Usuario registrado exitósamente !');

    }

    /**
     * Display the specified resource.
     *
     
     */
    public function show(User $users)
    {
      
      return view('users.show', [
        'users' => $users
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     
     */
    
    public function edit(User $users)
      {
        $sedes= Sedes::all();
        $vinculou= Vinculou::all(); 
        
        return view('users.edit',
        [
          'users'=>$users,
          'sedes'=>$sedes,
           'vinculous'=>$vinculou
        ]);
      }

    /**
     * Update the specified resource in storage.
     *
     
     */
    public function update(User $users, SaveUser2Request $request)
      {

       
    $users->update($request->validated()); //solo envia los que esten validados por SaveSedeRequest
        return redirect()->route('users.show',$users)->with('status','El Usuario fue actualizado con éxito');


      }

    /**
     * Remove the specified resource from storage.
     *
     
     */
    public function destroy(Users $users)
    {
      $users->delete();
      return redirect()->route('users.index')->with('status','La Sede fue eliminada con éxito');;
    }
}

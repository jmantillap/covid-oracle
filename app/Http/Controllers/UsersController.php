<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Entidades\Menus;
use Auth;
use App\Entidades\Sedes;
use App\Entidades\Vinculou;
use App\Entidades\Ciudad;
use App\Services\BannerServices;
use App\Utils\WebServicesUpb;
use DB;


//Importanto las validaciones
use App\Http\Requests\SaveUserRequest;
use App\Http\Requests\SaveUser2Request;
 

class UsersController extends Controller
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
         $vinculou= Vinculou::all();
         $ciudades = Ciudad::where('b_habilitado', '=', '1')->orderBY('t_nombre')->get();
         //dd($ciudades);
         return view('users.create',[
           'users' => new User,
           'ciudades' => $ciudades,
           'vinculous'=>$vinculou
         ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     
     */
    public function store(SaveUserRequest $request)
    {

      //dd(request()->all());
      $usuarioBanner=BannerServices::getUsuarioBannerNroDocumento(request('t_documento'));
      if($usuarioBanner!=null){                
          $data=WebServicesUpb::isExisteLdap($usuarioBanner->id);
          if($data->CN==$usuarioBanner->id){
              return redirect()->route('loginupb')->withErrors(array('usuario' =>'Ud. es Usuario UPB, Por favor autentíquese' ));
          }            
      }
      User::create($request->validated()); //solo envia los que esten validados por CreateUserRequest
      return redirect()->route('home')->with('status','¡ Usuario registrado exitósamente !');
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
        $ciudades= Ciudad::all();
        
        return view('users.edit',
        [
          'users'=>$users,
          'sedes'=>$sedes,
          'ciudades'=>$ciudades,
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

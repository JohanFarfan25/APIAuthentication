<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    //Validación de acceso por token de verificación
    public function __construct(){

        $this->middleware('auth.basic', ['only'=>['store', 'update', 'destroy']]);

    }

 
    //Listar los usuarios
    public function index(Request $request)
    {
        
        if ($request->has('Buscar')) {
            
            $users = User::Where('id', 'like', '%' . $request->Buscar. '%')
                ->orWhere('document_number', 'like', '%' . $request->Buscar .'%' )
                ->orWhere('email', 'like', '%' . $request->Buscar .'%' )
                ->orWhere('name', 'like', '%' . $request->Buscar .'%' )                                                             
                ->get();
        } else {
        $users = User::all();
        
        return response()->json(['data'=> $users], 200);
        }
        
        return response()->json(['data'=> $users], 200);
    }

 
    //Crear los usuarios
    public function store(Request $request)
    {

        try {

            $validators = [

                'name' => 'required',
                'last_name' => 'required',
                'document_number' => 'required',
                'cel_phone' => 'required',
                'email' => 'required|email|unique:users',
                'password'=> 'required|min:6'
    
            ];
    
            $this->validate($request, $validators);
    
            $campos = $request->all();
            $campos['password'] = bcrypt($request->password);
            $campos['verified'] = User::USUARIO_NO_VERIFICADO;
            $campos['verification_token'] = User::generarVerificationToken();
    
            User::create($campos);

            return response(['message'=> 'El Usuario'.' '.$request->get('email').' '. 'fue creado exitosamente'], 200);
            
        } catch (\Throwable $th) {
            //return back()->with('Error', ' El usuario ' . ' '.$request->get('email') . ' ' . ' ya existe ');

            return response(['message'=> 'El Usuario'.' '.$request->get('email').' '. 'Ya existe'], 422);
        }
        
        
        
    }

    public function show($id)
    {
        
        $user = User::find($id);
       
        return response()->json(['data'=> $user], 200);
    }


  
  

    //Actualizar usuarios
    public function update(Request $request, $id)

    {
        try {

            $user = User::findOrFail($id);
    
            if($request->has('name')){
                $user->name = $request->name;
            }
            if($request->has('email') && $user->email !=$request->email){
                $user->verified = User::USUARIO_NO_VERIFICADO;
                $user->verification_token = User::generarVerificationToken();
                $user->email = $request->email;
            }
            if($request->has('password')){
                $user->password = bcrypt($request->password);
            }
    
            if(!$user->isDirty()){
    
                return response(['message'=> 'El campo a actualizar no debe ser igual al valor actual', 'code'=>422], 422);
                
            }
    
            $user->save();
            return response(['data'=> $user], 200);

        } catch (\Throwable $th) {
            return response(['message'=> 'no se pudo actualizar'], 422);
        }
        

    }

 
    //Eliminar usuarios
    public function destroy($id)
    {
        
        $user = User::find($id);
        $user->delete();
        return response(['message'=> 'Usuario eliminado exitosamente'], 200);
    }

    //controlador de verifiación de usuario
    public function verify($token)
    {
        try {
            $user = User::where('verification_token', $token)->firstOrFail();
            $user->verified = User::USUARIO_VERIFICADO;
            
    
            $user->save();
            
            
            return view('MessageVerify');
            return response(['message'=> 'Usuario verificado exitosamente'], 200);

        } catch (\Throwable $th) {
            return response(['message'=> 'El usuario ya fue verificado'], 404);
        }
      
    }

}

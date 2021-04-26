<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Validación de acceso por token de verificación
    public function __construct()
    {
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
        return view('home')->with('users',$users );
        
        }
        
        
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

            return back()->with('Listo', ' El Usuario'.' '.$request->get('email').' '. 'fue creado exitosamente ¡, Debe ingresar al correo y activar la cuenta !');
            
            
        } catch (\Throwable $th) {
            

            return back()->with('Error', ' El Usuario'.' '.$request->get('email').' '. 'Ya existe');
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
    
                return back()->with('Error', ' El campo a actualizar no debe ser igual al valor actual ');
                
                
            }
    
            $user->save();
            return view('home')->with('users',$user );
            return response(['data'=> $user], 200);

            return back()->with('Listo', ' El usuario fue editado exitosamente ');

            

        } catch (\Throwable $th) {
            return back()->with('Error', ' El usuario no se pudo editar ');
        }     
    }

 
    //Eliminar usuarios
    public function destroy($id)
    {
       try {
        $user = User::find($id);
        $user->delete();
        return back()->with('Listo', ' Usuario eliminado exitosamente ');
       } catch (\Throwable $th) {
        return back()->with('Error', ' El Usuario no se pudo eliminar ');
       }
        
    }


    //Controlador de verifiación de usuario
    public function verify($token)
    {
        try {
            $user = User::where('verification_token', $token)->firstOrFail();
            $user->verified = User::USUARIO_VERIFICADO;           
    
            $user->save();            
            return view('MessageVerify');
            return back()->with('Listo', ' Usuario verificado exitosamente');

        } catch (\Throwable $th) {
            
            return back()->with('Error', ' El usuario ya fue verificado');
        }
      
    }
}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    //Para verificar si el usuario es verificado
    const USUARIO_VERIFICADO = '1';
    const USUARIO_NO_VERIFICADO = '0';




    //atributos del modelo
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'last_name',
        'document_number',
        'cel_phone',
        'verified',
        'verification_token',

    ];
   

//atrubuto que oculta los atiibutos que estan al momento de convertir 
//el modelo en una array formato json

    protected $hidden = [
        'password',
        'remember_token',
        //'verification_token',
    ];

   //este metodo nos permite generar automaticamente y apartir del modelo 
    //el token del usuario
    public function esVerificado(){

        return $this->verified == User::USUARIO_VERIFICADO;
    }

    //metodo publico estatico que permitira obtener un token de verificacion
    //generado automaticamente
    public static function generarVerificationToken(){
        return str_random(40);
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    
    public function store(Request $request){
        $message = [
            "email.email" => "El campo correo no es valido",
            "email.required" => "El campo correo es requerido",
            "password.required" => "El campo contraseña es requerida"
        ];
        $this->validate($request, [
            "email" => "required|email",
            "password" => "required"
        ], $message);

        

        if(!auth()->attempt($request->only("email", "password"), $request->remember)){
            return back()->with("message", "Credenciales incorrectas");
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}

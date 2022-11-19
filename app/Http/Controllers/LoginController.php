<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    
    public function store(Request $request){
        $required = "es requerido";
        $message = [
            "email.email" => "El campo correo no es valido",
            "email.required" => "El campo correo " . $required,
            "password.confirmed" => "El campo de confimación de contraseña no coincide"
        ];
        $this->validate($request, [
            "email" => "required|email",
            "password" => "required"
        ], $message);

        

        if(!auth()->attempt($request->only("email", "password"), $request->remember)){
            return back()->with("message", "Credenciales incorrectas");
        }

        return redirect()->route('posts.index');
    }
}

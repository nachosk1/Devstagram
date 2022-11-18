<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //dd($request);
        //dd($request->get("username"));

        //Validar el Request
        $request->request->add(['username' => Str::slug($request->username)]); //slug convierte el string en cadena ademas de convertir en minusculas

        //Validacion
        $required = "es requerido";
        $message = [
            "name.required" => "El campo nombre " . $required,
            "name.max" => "El campo nombre no debe tener más de 20 caracteres",
            "username.required" => "El campo nombre de usuario " . $required,
            "username.unique" => "El nombre de usuario ingresado ya esta en uso",
            "email.required" => "El campo correo " . $required,
            "email.email" => "El campo correo no es valido",
            "email.unique" => "El correo ingresado ya esta en uso",
            "password.confirmed" => "El campo de confimación de contraseña no coincide",
            "password.required" => "El campo contraseña " . $required,
            "password.min" => "El campo contraseña debe tener al menos 6 caracteres"
        ];
        $this->validate($request, [
            "name" => "required|max:20",
            "username" => "required|unique:users|min:3|max:20",
            "email" => "required|unique:users|email",
            "password" => "required|confirmed|min:6"
        ], $message );
 

        User::create([
            "name" => $request->name,
            //"username" => Str::lower($request->username),  Convertir en minuscula el texto ingresado
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        //Autenticar un usuario
        /*auth()->attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);*/

        //Otra forma de autenticar
        auth()->attempt($request->only("email", "password"));

        //Rredireccionar
        return redirect()->route('posts.index');
    }
}

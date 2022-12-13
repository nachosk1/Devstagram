<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('profile.index');
    }

    public function store(Request $request){
        //Validar el Request
        $request->request->add(['username' => Str::slug($request->username)]);

        $message = [
            "username.required" => "El campo nombre de usuario es requerido",
            "username.unique" => "El nombre de usuario ingresado ya esta en uso"
        ];
        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' .auth()->user()->id, 'min:3', 'max:20', 'not_in:edit-profile'] //laravel recomienda que cuando son mas de 3, sea un arreglo, ademas tambien existe la propiedad de in haciendo que solo se pueda ingresar el dato que esta en in
        ], $message);

        if($request->image){
            $image = $request->file('image');
            $nameImage = Str::uuid(). "." . $image->extension();   //el STR::uuid crea una id unico concatenado con el nombre
            $imageServer = Image::make($image);
            $imageServer->fit(1000, 1000);

            $imagePath = public_path('profiles') . '/' . $nameImage;
            $imageServer->save($imagePath);
        }

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->image = $nameImage ?? auth()->user()->image ?? null;  //nombre imagen o que esta vacio
        $usuario->save();

        //Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}

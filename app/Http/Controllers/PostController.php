<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //para no acceder a esta ruta sin iniciar sesion se hace este constructor
    //antes de entrar al index pasa por el contructor, la cual el middlware tiene una propia funcion que lo direcciona a una vista llamada login
    public function __construct()
    {
        $this->middleware("auth");  //antes de ejecutar el index, se va ejecutar el middleware para ver si el usuario esta autenticado, permitiendo proteger la ruta
    }
    
    public function index(User $user){
        return view("dashboard", [
            "user" => $user
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $message = [
            'title.required' => 'El campo titulo es requerido',
            'title.max' => 'El campo titulo no puede tener más de 50 caracteres',
            'description.required' => 'El campo descripción es requerido',
            'description.max' => 'El mapo descripción no puede tener más de 200 caracteres',
            'image.required' => 'La imagen es requerida'
        ];
        $this->validate($request, [
            'title' => 'required|max:50',
            'description' => 'required|max:200',
            'image' => 'required'
        ], $message);

        /*Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id
        ]);*/

        //Otra forma de registrar un post
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $request->image;
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect()->route('posts.index', auth()->user()->username);
    }
}

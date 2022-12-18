<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function __invoke(){             //este es un metodo invocable, lo que hace este metodo lo hace llamar automaticamente
        //Obtener a quienes seguimos 
        //dd(auth()->user()->followings->pluck('id')->toArray());
        $ids = auth()->user()->followings->pluck('id')->toArray();
        //$posts = Post::whereIn('user_id', $ids)->get();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        //enviar informacion a la vista
        return view('home',[
            'posts' => $posts       
        ]);
    }
}

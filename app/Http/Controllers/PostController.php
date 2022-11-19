<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");  //antes de ejecutar el index, se va ejecutar el middleware para ver si el usuario esta autenticado, permitiendo proteger la ruta
    }
    
    public function index(User $user){
        
        return view("dashboard", [
            "user" => $user
        ]);
    }
}

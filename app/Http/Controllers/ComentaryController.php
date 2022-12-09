<?php

namespace App\Http\Controllers;

use App\Models\Comentary;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentaryController extends Controller
{
    public function store(Request $request, User $user, Post $post){

        $message = [
            'comentary.required' => 'El campo comentario es requerido',
            'comentary.max' => 'El campo comentario no puede contener mas de 255 caracteres'
        ];
        $this->validate($request, [
            'comentary' => 'required|max:255'
        ], $message);

        Comentary::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentary' => $request->comentary
        ]);

        return back()->with('message', 'Comentario Realizado Correctamente');
    }
}

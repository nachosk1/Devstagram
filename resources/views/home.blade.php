@extends('layouts.app')

@section('title')
    Pagina Principal
@endsection

@section('contents')
    <h1 class="text-4xl text-center font-black my-10">Publicaciones</h1>
    <x-list-post :posts="$posts"/>
    
@endsection
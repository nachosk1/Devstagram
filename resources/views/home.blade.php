@extends('layouts.app')

@section('title')
    Pagina Principal
@endsection

@section('contents')
    <x-list-post :posts="$posts"/>
    
@endsection
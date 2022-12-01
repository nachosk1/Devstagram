@extends('layouts.app')

@section('title')
    Inicia Sesión en Devstagram
@endsection
@section('contents')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="imagen login de usuario">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('login') }}"  method="POST"  novalidate>
                @csrf
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Correo
                    </label>
                    <input type="email" id="email" name="email" placeholder="Tu Correo de Registro" value="{{ old('email') }}" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"">
                    @error("email")
                        <p class="bg-red-400 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña
                    </label>
                    <input type="password" id="password" name="password" placeholder="Tu Contraseña de Registro" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"">
                    @error("password")
                        <p class="bg-red-400 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                    @enderror
                    @if(session("message"))
                        <p class="bg-red-400 text-white my-2 rounded-lg text-sm p-2">{{ session("message") }}</p>
                    @endif
                </div>
                <div class="mb-5">
                    <input type="checkbox" name="remember"> 
                    <label for="remember" class="text-gray-500 font-bold">Mantener mi sesion abierta</label> 
                </div>
                
                <input type="submit" value="Iniciar Sesion" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
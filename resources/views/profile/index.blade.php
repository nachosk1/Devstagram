@extends('layouts.app')

@section('title')
    Editar Profile - {{ auth()->user()->username}}
@endsection

@section('contents')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6 mx-4">
            <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input type="text" id="username" name="username" placeholder="Tu Username" value="{{ auth()->user()->username }}" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror">
                    @error("username")
                        <p class="bg-red-400 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="image" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen Perfil
                    </label>
                    <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png"  value="" class="border p-3 w-full rounded-lg" >
                    @error("image")
                        <p class="bg-red-400 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Guardar Cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

            </form>
        </div>
    </div>
@endsection
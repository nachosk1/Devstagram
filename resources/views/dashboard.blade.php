@extends('layouts.app')

@section('title')
    Perfil: {{$user->username}}
@endsection

@section('contents')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5 ">
                <img src="{{ $user->image ? asset("profiles"). '/' . $user->image : asset('img/user.png') }}" alt="imagen usuario" class="w-4/5 rounded-full">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <div class="flex items-center gap-2 mb-5">
                    <p class="text-gray-700 text-2xl ">{{ $user->username }}</p>

                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('profile.index')}}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>
                
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->followers()->count()}}
                    <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers()->count())</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->followings()->count()}}
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts()->count() }}
                    <span class="font-normal">Post</span>
                </p>
                @auth
                    @if ($user->id !== auth()->user()->id)
                        @if (!$user->checkFollow(auth()->user()))
                            <form action="{{ route('users.follow', $user) }}" method="POST">
                                @csrf
                                <input type="submit" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Seguir">
                            </form>
                        @else
                            <form action="{{ route('users.unfollow', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Dejar de Seguir">
                            </form>
                        @endif
                    @endif
                @endauth
                
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div>
                        <a href="{{ route('posts.show', ['post' => $post, 'user' => $user]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="imagen del post {{ $post->title }}">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="my-10">
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay posts</p>
        @endif
    </section>
@endsection


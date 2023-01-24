<div>
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-4">
            @foreach ($posts as $post)
                <div>
                    <p class="font-bold text-xl">{{ $post->user->username}}</p>
                    <p class="text-gray-500 mb-1 text-xs">{{ $post->created_at->diffForHumans()}}</p>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->image }}" alt="imagen del post {{ $post->title }}">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{$posts->links()}}
        </div>
    @else
        <p class="text-center">No hay Publicaciones, sigue a alguien para poder ver sus contenido</p>
    @endif
</div>
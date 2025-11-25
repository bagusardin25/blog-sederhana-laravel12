@props(['post'])

<article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <div class="p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm text-gray-500">{{ $post->created_at->format('d M Y') }}</span>
            <span class="text-sm font-medium text-indigo-600">{{ $post->author }}</span>
        </div>
        <h2 class="text-2xl font-bold mb-2 text-gray-800 hover:text-indigo-600">
            <a href="{{ route('posts.show', $post) }}">
                {{ $post->title }}
            </a>
        </h2>
        <p class="text-gray-600 mb-4">
            {{ Str::limit($post->content, 150) }}
        </p>
        <div class="flex items-center justify-between">
            <a href="{{ route('posts.show', $post) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                Baca Selengkapnya &rarr;
            </a>
            
            @auth
                @if(auth()->id() === $post->user_id)
                    <div class="flex space-x-2">
                        <a href="{{ route('posts.edit', $post) }}" class="text-yellow-500 hover:text-yellow-600">
                            Edit
                        </a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus post ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600">
                                Hapus
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</article>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">5 Postingan Terbaru (Query Builder)</h3>
                    @if(isset($latestPosts) && count($latestPosts) > 0)
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($latestPosts as $post)
                                <li class="py-3">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <a href="{{ route('posts.show', $post->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold dark:text-indigo-400">
                                                {{ $post->title }}
                                            </a>
                                            <p class="text-sm text-gray-500">Oleh: {{ $post->author_name }}</p>
                                        </div>
                                        <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Belum ada postingan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

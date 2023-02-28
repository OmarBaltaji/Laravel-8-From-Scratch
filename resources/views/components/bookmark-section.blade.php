@props(['post'])

@auth
    @if ($post->author->id !== auth()->user()->id)
        <a href="javascript:;" class="mr-3 relative" 
            x-data="{ tooltip: false }"
            @click.prevent="document.querySelector('#bookmark-form').submit()"
            x-on:mouseover="tooltip = true"
            x-on:mouseleave="tooltip = false" 
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ in_array($post->id, auth()->user()->bookmarks->pluck('id')->toArray()) ? '#000' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
            </svg>

            <x-tooltip message="Bookmark" class="w-15 -left-8" />
        </a>      
        <form id="b6ookmark-form" action="/bookmarks/{{ $post->id }}" method="POST" class="hidden">
            @csrf
        </form>           
    @endif
@endauth

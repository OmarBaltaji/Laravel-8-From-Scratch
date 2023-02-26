<x-layout>
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
            <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                <img src="{{$post->thumbnail ? asset('storage/' . $post->thumbnail) : '/images//illustration-1.png'}}" alt="" class="rounded-xl w-full max-h-96">

                @if ($post->status === 'published')
                    <div class="flex items-center justify-between mt-4">
                        <a href="javascript:;" class="text-xs text-gray-500 relative" 
                            id="post-views-container"
                    
                            x-data="{ tooltip: false }"
                            x-on:mouseover="tooltip = true"
                            x-on:mouseleave="tooltip = false"
                        >
                            <span x-show="tooltip" 
                                class="absolute group-hover:flex -left-20 -top-8 -translate-y-full w-48 px-2 py-1 bg-blue-500 rounded-lg text-center text-white text-sm" 
                                style="display: none;"
                            >
                                This post has {{ $post->view_count }} views 
                            </span>

                            <div class="flex items-center">
                                <div class="w-5 mr-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-20 h-20">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                {{ $post->view_count }}
                            </div>
                        </a>
                        <p class="block text-gray-400 text-xs">
                            Published <time>{{ $post->published_at->diffForHumans() }}</time>
                        </p>
                    </div>
                @endif

                <div class="flex items-center lg:justify-center text-sm mt-4">
                    <img src="/images//lary-avatar.svg" alt="Lary avatar">
                    <div class="ml-3 text-left">
                        <h5 class="font-bold">
                            <a href="/?author={{ $post->author->username }}">{{ ucwords($post->author->name) }}</a>
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-span-8">
                <div class="hidden lg:flex justify-between mb-6">
                    <a href="/"
                        class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                        <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                            <g fill="none" fill-rule="evenodd">
                                <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                </path>
                                <path class="fill-current"
                                    d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                </path>
                            </g>
                        </svg>

                        Back to Posts
                    </a>

                    <div class="space-x-2">
                        <x-category-button :category="$post->category"/>
                    </div>
                </div>

                <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                    {{ $post->title }}
                </h1>

                <div class="space-y-4 lg:text-lg leading-loose">
                    {!! $post->body !!}
                </div>
            </div>

            <section class="col-span-8 col-start-5 mt-10 space-y-6">
                @include('posts._add-comment-form')
                
                @foreach ($post->comments as $comment)
                    <x-post-comment :comment="$comment" />
                @endforeach
            </section>
        </article>
    </main>
</x-layout>
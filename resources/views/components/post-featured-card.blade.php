@props(['post'])

<article
class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
<div class="py-6 px-5 lg:flex">
    <div class="flex-1 lg:mr-8">
        <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : '/images/illustration-3.png' }}" alt="Blog Post illustration" class="rounded-xl w-full max-h-96">
    </div>

    <div class="flex-1 flex flex-col justify-between">
        <header class="mt-8 lg:mt-0">
            <div class="space-x-2">
               <x-category-button :category="$post->category" />
            </div>

            <div class="mt-4">
                <h1 class="text-3xl">
                  <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
                </h1>

                <span class="mt-2 block text-gray-400 text-xs">
                        Published <time>{{ $post->published_at->diffForHumans() }}</time>
                    </span>
            </div>
        </header>

        <div class="text-sm mt-2 space-y-4">
            {!! $post->excerpt !!}     
        </div>

        <footer class="flex justify-between items-center mt-8">
            <div class="flex items-center text-sm">
                <img src="/images//lary-avatar.svg" alt="Lary avatar">
                <div class="ml-3 text-center">
                    <h5 class="font-bold mb-2">
                        <a href="/?author={{ $post->author->username }}">{{ ucwords($post->author->name) }}</a>
                    </h5>
                    
                    @php $is_auth_a_follower = in_array(auth()->user()->id, $post->author->followers->pluck('id')->toArray()); @endphp
                    
                    <button x-data="{}" @click.prevent="document.querySelector('#follow-form').submit()" class="bg-blue-500 px-4 py-2 text-white rounded-3xl text-xs {{ $is_auth_a_follower ? 'opacity-75' : '' }}">{{  $is_auth_a_follower ? 'Unfollow' : 'Follow' }}</button>
                    
                    <form id="follow-form" action="follow/{{ $post->author->id }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>

            <div class="hidden lg:block">
                <a href="/posts/{{ $post->slug }}"
                   class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                >Read More</a>
            </div>
        </footer>
    </div>
</div>
</article>
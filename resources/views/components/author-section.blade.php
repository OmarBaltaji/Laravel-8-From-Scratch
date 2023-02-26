@props(['post'])

<div {{ $attributes->merge(['class' => 'flex items-center text-sm']) }} >
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
@auth
  <x-panel>
      <form action="/posts/{{ $post->slug }}/comments" method="POST">
          @csrf

          <header class="flex items-center">
            <x-avatar :avatar="auth()->user()->avatar" />
              <h2 class="ml-4">Want to participate?</h2>
          </header>

          <div class="mt-6">
              <textarea class="w-full text-xs focus:outline-none focus:ring" required placeholder="Quick, think of something to say!" name="body" cols="30" rows="5"></textarea>
              @error('body')
                <span class="text-xs text-red-500">{{ $message }}</span>
              @enderror
          </div>

          <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
            <x-form.button>Post</x-form.button>
          </div>
      </form>
  </x-panel>
  @else
  <p class="font-semibold">
      <a class="hover:underline text-blue-500" href="/register">Register</a> or
      <a class="hover:underline text-blue-500" href="/login">Login</a> 
      to leave a comment
  </p>
@endauth
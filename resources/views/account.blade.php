<x-layout>
  <section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 border-b pb-2">Account</h1>
    <form action="/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <x-form.input name="username" :value="$user->username" />
      
      <div class="flex mt-6">
        <div class="flex-1">
          <x-form.input name="avatar" type="file" accept="image/*" />
        </div>
        <img src="{{$user->avatar ? asset('storage/' . $user->avatar) : '/images/lary-avatar.svg'}}" alt="" class="rounded-xl ml-6" width="80">
      </div>

      <x-form.button>Update</x-form.button>
    </form>
  </section>
</x-layout>
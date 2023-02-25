<x-layout>
  <x-setting :heading="'Edit Post: ' . $post->title">
    <form action="/admin/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <x-form.input name="title" :value="old('title', $post->title)" required  />

      <x-form.input name="slug" :value="old('slug', $post->slug)" required />
      
      <div class="flex mt-6">
        <div class="flex-1">
          <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)" />
        </div>
        <img src="{{$post->thumbnail ? asset('storage/' . $post->thumbnail) : '/images//illustration-1.png'}}" alt="" class="rounded-xl ml-6" width="100">
      </div>

      <x-form.textarea name="excerpt">{{ old('excerpt', $post->excerpt) }}</x-form.textarea>
      
      <x-form.textarea name="body">{{ old('excerpt', $post->body) }}</x-form.textarea>
      
      <x-form.select name="category" :list="App\Models\Category::all()" isIdUsed="{{ true }}" :post="$post" />
      
      <x-form.select name="status" :list="config('constants.statuses')" isIdUsed="{{ false }}" :post="$post" />

      <x-form.button>Update</x-form.button>
    </form>
  </x-setting>
</x-layout>
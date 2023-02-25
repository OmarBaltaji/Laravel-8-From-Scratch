<x-layout>
  <x-setting heading="Publish New Post">
    <form action="/admin/posts" method="POST" enctype="multipart/form-data">
      @csrf

      <x-form.input name="title" required />

      <x-form.input name="slug"  required />
      
      <x-form.input name="thumbnail" type="file" accept="image/*" />
      
      <x-form.textarea name="excerpt">{{ old('excerpt') }}</x-form.textarea>
      
      <x-form.textarea name="body">{{ old('body') }}</x-form.textarea>
      
      <x-form.select name="category" :list="App\Models\Category::all()" isIdUsed="{{ true }}" />

      <x-form.select name="status" :list="config('constants.statuses')" isIdUsed="{{ false }}" />

      <x-form.button>Publish</x-form.button>
    </form>
  </x-setting>
</x-layout>
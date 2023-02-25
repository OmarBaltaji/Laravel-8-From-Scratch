<x-layout>
  <x-setting heading="Publish New Post">
    <form action="/admin/posts" method="POST" enctype="multipart/form-data">
      @csrf

      <x-form.input name="title" required />

      <x-form.input name="slug"  required />
      
      <x-form.input name="thumbnail" type="file" accept="image/*" />
      
      <x-form.textarea name="excerpt">{{ old('excerpt') }}</x-form.textarea>
      
      <x-form.textarea name="body">{{ old('body') }}</x-form.textarea>
      

      <x-form.field>
        <x-form.label name="category" />
        <select name="category_id" id="category" class="w-full border border-gray-400 py-2 px-4">
          @foreach (App\Models\Category::all() as $category)
            <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : ''  }}>{{ ucwords($category->name) }}</option>            
          @endforeach
        </select>
        <x-form.error name="category" />
      </x-form.field>

      <x-form.button>Publish</x-form.button>
    </form>
  </x-setting>
</x-layout>
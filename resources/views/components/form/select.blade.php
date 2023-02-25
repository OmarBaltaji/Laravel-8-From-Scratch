@props(['name', 'list' => [], 'isCollection' => false, 'post' => null])

<x-form.field>
  <x-form.label :name="$name" />
  @php
    if($isCollection) {
      $model = "\App\Models\\" . ucwords($name);
      $list = $model::all();
    }
    $relation_name = $name === 'user' ? 'author' : $name;
    $name = $isCollection ? $name . '_id' : $name;
  @endphp
  <select name="{{ $name }}" id="{{ $name }}" class="w-full border border-gray-400 py-2 px-4">
    @foreach ($list as $item)
      @php $value = $isCollection ? $item->id : $item; @endphp
      <option value="{{ $value }}" {{ $value == old($name, $post ? ($isCollection ? $post->{$relation_name}->id : $post->{$name}) : '') ? 'selected' : ''  }}>{{ ucwords($isCollection ? $item->name : $item ) }}</option>            
    @endforeach
  </select>
  <x-form.error :name="$name" />
</x-form.field>
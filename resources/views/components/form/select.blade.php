@props(['name', 'list', 'isIdUsed', 'post' => null])

<x-form.field>
  <x-form.label :name="$name" />
  @php
    $post_name = $isIdUsed ? $name . '_id' : $name;
  @endphp
  <select name="{{ $post_name }}" id="{{ $name }}" class="w-full border border-gray-400 py-2 px-4">
    @foreach ($list as $item)
      @php $value = $isIdUsed ? $item->id : $item; @endphp
      <option value="{{ $value }}" {{ $value == old($post_name, $post ? ($isIdUsed ? $post->{$name}->id : $post->{$name}) : '') ? 'selected' : ''  }}>{{ ucwords($isIdUsed ? json_decode($item)->name : $item ) }}</option>            
    @endforeach
  </select>
  <x-form.error :name="$name" />
</x-form.field>
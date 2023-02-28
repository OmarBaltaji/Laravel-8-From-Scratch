@props(['message'])

<span x-show="tooltip" 
  {{ $attributes->merge(['class' => 'absolute -top-8 -translate-y-full px-2 py-1 bg-blue-500 rounded-lg text-center text-white text-sm']) }}
  style="display: none;"
>
  {{ $message }}
</span>
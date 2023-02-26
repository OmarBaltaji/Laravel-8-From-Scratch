@props(['type'])

<div x-data="{show: true}" 
    x-init="setTimeout(() => show = false, 4000)" 
    x-show="show" 
    class="fixed bottom-3 right-3 bg-{{ $type === 'success' ? 'blue' : 'red' }}-500 text-white text-sm py-2 px-4 rounded-xl"
>
  <p>{{ session($type) }}</p>
</div>
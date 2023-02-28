@props(['avatar'])

<img src="{{ $avatar ? asset('storage/' . $avatar) : '/images//lary-avatar.svg' }}" {{ $attributes->merge(['class' => '']) }} alt="User's avatar" width="70">
<x-dropdown>
    <x-slot name="trigger">
        <button class="py-2 pl-3 pr-9 text-sm lg:w-32 font-semibold text-left flex w-full lg:inline-flex">
            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}

            <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;"/>
        </button>
    </x-slot>
    @php
        $isCategoryNull = request()->get("category") === null;
    @endphp
    <x-dropdown-item href="/?{{ http_build_query(request()->except('category', 'page')) }}" :active="$isCategoryNull && request()->routeIs('home')">All</x-dropdown-item>
    @foreach ($categories as $category)
        <x-dropdown-item 
            {{-- href="/categories/{{ $category->slug }}" --}}
            href="?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}"
            {{-- :active="isset($currentCategory) && $currentCategory->is($category)" --}}
            {{-- :active='request()->is("categories/{$category->slug}")' --}}
            :active='request()->get("category") === "{$category->slug}"'
            {{-- :active="request()->is('*' . $category->slug)" --}} {{-- the uri here can be anything but needs to contain the category slug --}}
        >
            {{ ucwords($category->name) }}
        </x-dropdown-item>
    @endforeach
</x-dropdown>

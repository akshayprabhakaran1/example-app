<x-dropdown>

    <x-slot name="trigger">
        <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}
            <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;" />
        </button>
    </x-slot>

    {{-- works with named routes --}}
    <x-dropdown-item href="/?{{ $category->slug }} & {{ http_build_query(request()->except('category', 'page')) }}" 
        :active="request()->routeIs('home')">All</x-dropdown-item>
    {{-- isset($currentCategory) && $currentCategory->is($category) --}}

    {{-- check the url if the url matches with the category then true --}}
    {{-- request()->is('categories/'. $category->slug) --}}
    {{-- we can use wild cards too --}}
    {{-- request()->is('*'. $category->slug) --}}

    @foreach ($categories as $category)
        <x-dropdown-item href="/?category={{ $category->slug }} & {{ http_build_query(request()->except('category', 'page')) }}" 
            :active="request()->is('categories/' . $category->slug)">
            {{ ucwords($category->name) }}
        </x-dropdown-item>
    @endforeach
</x-dropdown>

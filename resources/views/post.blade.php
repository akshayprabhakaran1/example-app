<x-layout>
    <article>
        <h1>{{ $post -> title }}</h1>
        <div>
            {{-- !! is used to not escape the html tag --}}
            {{-- only use it when you are in control of the data --}}
            {!! $post -> body !!}
        </div>
    </article>
    <a href="/">Go Back!</a>
</x-layout>
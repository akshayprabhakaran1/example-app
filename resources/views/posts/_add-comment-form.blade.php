@auth
    <x-panel>

        <form action="/posts/{{ $post->slug }}/comments" method="post" class="border border-gray-200 rounded-xl p-6">
            @csrf

            <header class="flex items-center">
                <img class="rounded-full" src="https://i.pravatar.cc/60?u={{ auth()->id() }}"
                     width="40" height="40" alt="">
                <h2 class="ml-4">Want to participate?</h2>
            </header>

            <div class="mt-8">
                <textarea name="body"
                          class="w-full text-sm focus:outline-none focus:ring rounded-xl"
                          rows="5"
                          placeholder="Quick, think of something to say!"
                          required>
                </textarea>
                @error('body')
                    <span class="text-xs text-red">{{ $message  }}</span>
                @enderror
            </div>

            <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                <x-submit-button>Post</x-submit-button>
            </div>

        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="/register" class="hover:underline">Register</a> or <a href="/login" class="hover:underline">Log in </a> to leave a comment.
    </p>
@endauth

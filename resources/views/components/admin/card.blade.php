@props(['title', 'link', 'color'])

<a href="{{ $link }}" class="block p-6 rounded-2xl shadow-md text-white {{ $color }} hover:scale-105 transform transition">
    <h3 class="text-xl font-semibold">{{ $title }}</h3>
    <p class="mt-2 text-sm opacity-80">Click to manage</p>
</a>

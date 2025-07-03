@props(['title', 'description', 'link', 'color'])

<a href="{{ $link }}" class="block p-6 rounded-2xl shadow-md text-black {{ $color }} hover:scale-105 transition duration-300">
    <h3 class="text-lg font-bold">{{ $title }}</h3>
    <p class="text-sm mt-2 opacity-80">{{ $description }}</p>
</a>

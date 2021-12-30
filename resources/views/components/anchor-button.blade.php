@props(['href', 'attributes'])
<a href="{{ $href }}" {{ $attributes }} class="bg-gradient-to-br from-red-500 via-red-500 to-red-600 border border-red-800 rounded-full px-2 m-2 text-white shadow-lg inline-block active:shadow active:scale-95">{{ $slot }}</a>

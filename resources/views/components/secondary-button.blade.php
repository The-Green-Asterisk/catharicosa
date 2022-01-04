@props(['href'])
<a href="{{ $href }}" {{ $attributes->merge(['class' => 'bg-gradient-to-br from-white via-white to-gray-100 border border-red-800 rounded-full px-2 m-2 text-black shadow-lg inline-block active:shadow active:scale-95']) }}>{{ $slot }}</a>

@props(['color' => 'green', 'text'])
 
<span class="relative inline-block my-1 px-3 py-1 font-semibold text-{{ $color }}-900">
    <span aria-hidden class="absolute inset-0 bg-{{ $color }}-200 opacity-50 rounded-full"></span>
    <span class="relative">{{ $text }}</span>
</span>
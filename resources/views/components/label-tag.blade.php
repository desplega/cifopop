@props(['color' => 'blue', 'text'])

@php
    // Can't use string concatenation to create class names
    // We need to dynamically select a complete class name
    if ($color == 'blue') {
        $text_color = 'text-blue-900';
        $bg_color = 'bg-blue-200';
    } else {
        $text_color = 'text--900';
        $bg_color = 'bg-red-200';
    }
@endphp
 
<span class="relative inline-block my-1 px-3 py-1 font-semibold {{ $color == 'blue' ? 'text-blue-900' : 'text-red-900' }}">
    <span aria-hidden class="absolute inset-0 {{ $color == 'blue' ? 'bg-blue-200' : 'bg-red-200' }} opacity-50 rounded-full"></span>
    <span class="relative">{{ $text }}</span>
</span>

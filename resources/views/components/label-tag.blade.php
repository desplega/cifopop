@props(['color' => 'blue', 'text'])

<span class="relative inline-block my-1 px-3 py-1 font-semibold {{ $color == 'blue' ? 'text-blue-900' : 'text-red-900' }}">
    <span aria-hidden class="absolute inset-0 {{ $color == 'blue' ? 'bg-blue-200' : 'bg-red-200' }} opacity-50 rounded-full"></span>
    <span class="relative">{{ $text }}</span>
</span>

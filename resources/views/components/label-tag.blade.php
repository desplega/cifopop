@props(['color' => 'blue', 'text'])

<span
    class="inline-block {{ $color == 'blue' ? 'bg-blue-200' : 'bg-red-200' }} rounded-full px-3 py-1 text-sm font-semibold {{ $color == 'blue' ? 'text-blue-900' : 'text-red-900' }} mr-2 mb-2">
    {{ $text }}
</span>

@props(['color' => 'green', 'message'])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 {{ $color == 'green' ? 'bg-green-200 text-green-900' : 'bg-red-200 text-red-900' }}">
        <div>{{ $message }}</div>
        {{ $slot }}
    </div>
</div>

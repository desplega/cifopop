<!-- Received offers -->
@props(['received_offers'])

<div class="text-gray-900 font-bold text-2xl tracking-tight mt-4 px-8 dark:text-white">
    {{ __('Received offers') }}
</div>
<div class="p-6 bg-white">
    <div class="flex flex-wrap">
        @forelse ($received_offers as $offer)
            <x-advert-received-offer :offer="$offer" />
        @empty
            <p class="px-2">{{ __('No results') }}</p>
        @endforelse
    </div>
</div>

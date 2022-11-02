<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Advert details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Content --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-advert-details :advert="$advert" />
                </div>
            </div>

            @auth
                @if (Auth::user()->id == $advert->user_id)
                    <!-- Received offers -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="text-gray-900 font-bold text-2xl tracking-tight mt-4 px-8 dark:text-white">
                            {{ __('Received offers') }}
                        </div>
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex flex-wrap">
                                @forelse ($received_offers as $offer)
                                    @can('view', $offer)
                                        <x-offer-received-advert :offer="$offer" />
                                    @endcan
                                @empty
                                    <p class="px-2">{{ __('No results') }}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Created offer -->
                    @if ($created_offer)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                            <div class="text-gray-900 font-bold text-2xl tracking-tight mt-4 px-8 dark:text-white">
                                {{ __('Created offer') }}
                            </div>
                            <div class="p-6 bg-white border-b border-gray-200">
                                <div class="flex flex-wrap">
                                    <x-offer-created-advert :offer="$created_offer" />
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endauth
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adverts') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Content --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-advert-search :title="$title ?? ''" :description="$description ?? ''" />
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap">
                        @forelse ($adverts as $advert)
                            <x-advert-card :advert="$advert" />
                        @empty
                            <p class="px-2">{{ __('No results') }}</p>
                        @endforelse
                    </div>
                    @if ($adverts->hasPages())
                        <div class="mt-4">
                            {{ $adverts->links() }}
                        </div>
                    @endif
                </div>
            </div>

            @if (isset($deleted_adverts))
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="text-gray-900 font-bold text-2xl tracking-tight mt-4 px-8 dark:text-white">
                        {{ __('Deleted adverts') }}
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-wrap">
                            @forelse ($deleted_adverts as $advert)
                                <x-deleted-advert-card :advert="$advert" />
                            @empty
                                <p class="px-2">{{ __('No results') }}</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Adverts') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Content --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="text-gray-900 font-bold text-2xl tracking-tight mt-4 px-8 dark:text-white">
                    {{ __('Active Adverts') }}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-advert-card :adverts="$adverts" />
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="text-gray-900 font-bold text-2xl tracking-tight mt-4 px-8 dark:text-white">
                    {{ __('Deleted Adverts') }}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-deleted-advert-card :adverts="$deleted_adverts" />
                </div>
            </div>

            @if ($adverts->hasPages())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 bg-white border-b border-gray-200">
                        {{ $adverts->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ooops! Something went wrong!') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Content --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-error
                        error="{{ __('Forbidden') }}"
                        image="{{ asset('images/errors/error-403.png') }}"
                        description="{{ $exception->getMessage() ?: __('You don\'t have rights to do this operation.') }}"
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

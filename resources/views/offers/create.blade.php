<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New offer') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Content --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('offer.store') }}">
                        @csrf

                        <input type="hidden" name="advert_id" value={{ $advert_id }}>

                        <!-- Text -->
                        <div class="mt-4">
                            <x-input-label for="text" :value="__('Text')" />

                            <x-textarea id="text" class="block mt-1 w-full" name="text" required>
                                {{ old('text') }}
                            </x-textarea>

                            <x-input-error :messages="$errors->get('text')" class="mt-2" />
                        </div>
                        <!-- Amount -->
                        <div class="mt-4">
                            <x-input-label for="amount" :value="__('Amount')" />

                            <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount"
                                :value="old('amount')" min="0" step="0.01" required />

                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>
                        <!-- Due date -->
                        <div class="mt-4">
                            <x-input-label for="due_date" :value="__('Due date')" />

                            <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date"
                                :value="old('due_date')" />

                            <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                        </div>

                        <!-- Form buttons -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button type="reset" class="ml-3">
                                {{ __('Reset') }}
                            </x-primary-button>
                            <x-primary-button class="ml-3">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

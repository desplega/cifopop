<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact Form') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Content --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />

                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus />

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />

                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required />

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Subject -->
                        <div class="mt-4">
                            <x-input-label for="subject" :value="__('Subject')" />

                            <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject"
                                :value="old('subject')" required />

                            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </div>

                        <!-- Message -->
                        <div class="mt-4">
                            <x-input-label for="message" :value="__('Message')" />

                            <x-textarea id="message" class="block mt-1 w-full" name="message" required>
                                {{ old('message') }}
                            </x-textarea>

                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>

                        <!-- Send button -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button type="reset" class="ml-3">
                                {{ __('Reset') }}
                            </x-primary-button>
                            <x-primary-button class="ml-3">
                                {{ __('Send') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

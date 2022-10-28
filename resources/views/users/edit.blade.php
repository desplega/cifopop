<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit user') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Content --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />

                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name', $user->name)" required autofocus />

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />

                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email', $user->email)" required />

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- City -->
                        <div class="mt-4">
                            <x-input-label for="city" :value="__('City')" />

                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                                :value="old('city', $user->city)" required />

                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <!-- Phone -->
                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('Phone')" />

                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                :value="old('phone', $user->phone)" />

                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- Roles -->
                        <div class="mt-4">
                            <x-input-label :value="__('Roles')" />
                        </div>
                        <div class="block mt-4">
                            <label for="administrator" class="inline-flex items-center mr-3">
                                <input id="administrator" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    name="administrator" {{ $user->hasRole('Administrator') ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Administrator') }}</span>
                            </label>
                            <label for="editor" class="inline-flex items-center mr-3">
                                <input id="editor" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    name="editor" {{ $user->hasRole('Editor') ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Editor') }}</span>
                            </label>
                            <label for="blocked" class="inline-flex items-center mr-3">
                                <input id="blocked" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    name="blocked" {{ $user->hasRole('Blocked') ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Blocked') }}</span>
                            </label>
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

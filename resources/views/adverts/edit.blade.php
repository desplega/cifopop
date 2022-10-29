<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit advert') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Content --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('advert.update', $advert->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="flex justify-between mt-4">
                            <div>
                                <!-- Reference -->
                                <x-input-label for="ref" :value="__('Ref')" />
    
                                {{ old('id', $advert->id) }}
                            </div>
                            <div>
                                <!-- Show icon -->
                                <a class="inline-block mx-1" href="{{ route('advert.show', $advert->id) }}">
                                    <img height="20" width="20" src="{{ asset('images/buttons/show.png') }}" alt="Ver detalles" title="Ver detalles">
                                </a>
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Title')" />

                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title', $advert->title)" required autofocus />

                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />

                            <x-textarea id="description" class="block mt-1 w-full" name="description" required>
                                {{ old('description', $advert->description) }}
                            </x-textarea>

                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <!-- Price -->
                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Price')" />

                            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price"
                                :value="old('price', $advert->price)" min="0" step="0.01" required />

                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <!-- Image -->
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Image')" />

                            <img class="h-60 my-4"
                                src="{{ $advert->image ? asset('storage/' . config('filesystems.advertImagesPath')) . '/' . $advert->image : asset('images/adverts/default.jpg') }}"
                                alt="{{ __('Advert ref. :advert', ['advert' => $advert->id]) }}"
                                title="{{ __('Advert ref. :advert', ['advert' => $advert->id]) }}">

                            <input class="mt-1 w-full" name="image" type="file" class="" id="image">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
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

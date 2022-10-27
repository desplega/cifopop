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
                    <form method="POST" action="{{ route('advert.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="title"
                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Title') }}</label>
                            <input name="title" value="{{ old('title') }}" type="text"
                                class="rounded py-2 px-3 text-gray-700" id="title" placeholder="{{ __('Title') }}"
                                maxlength="255" required="required">
                        </div>
                        <div class="mb-4">
                            <label for="description"
                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Description') }}</label>
                            <textarea name="description" type="text" class="rounded py-2 px-3 text-gray-700" id="description"
                                placeholder="{{ __('Description') }}" required="required">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="price"
                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Price') }}</label>
                            <input name="price" value="{{ old('price') }}" type="number"
                                class="rounded py-2 px-3 text-gray-700" id="price" min="0" step="0.01"
                                placeholder="{{ __('Price') }}" required="required">
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Image') }}</label>
                            <input name="image" type="file" class="" id="image">
                        </div>

                        <div>
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Guardar</button>
                            <button type="reset"
                                class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Restablecer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

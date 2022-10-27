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

                        <div class="mb-4">
                            <label for="name"
                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Name') }}</label>
                            <input name="name" value="{{ old('name', $user->name) }}" type="text"
                                class="rounded py-2 px-3 text-gray-700" id="name" placeholder="{{ __('Name') }}"
                                maxlength="255" required="required">
                        </div>
                        <div class="mb-4">
                            <label for="email"
                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Email') }}</label>
                            <input name="email" value="{{ old('email', $user->email) }}" type="email"
                                class="rounded py-2 px-3 text-gray-700" id="email"
                                placeholder="{{ __('Email') }}" maxlength="255" required="required">
                        </div>
                        <div class="mb-4">
                            <label for="city"
                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('City') }}</label>
                            <input name="city" value="{{ old('city', $user->city) }}" type="text"
                                class="rounded py-2 px-3 text-gray-700" id="city"
                                placeholder="{{ __('City') }}" maxlength="255" required="required">
                        </div>
                        <div class="mb-4">
                            <label for="phone"
                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Phone') }}</label>
                            <input name="phone" value="{{ old('phone', $user->phone) }}" type="text"
                                class="rounded py-2 px-3 text-gray-700" id="phone"
                                placeholder="{{ __('Phone') }}" maxlength="255" required="required">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">{{ __('Roles') }}</label>
                            <input type="checkbox" name="administrator" value="Administrator"
                                {{ $user->hasRole('Administrator') ? 'checked' : '' }}>
                            <label for="administartor"> Administrator</label><br>
                            <input type="checkbox" name="editor" value="Editor"
                                {{ $user->hasRole('Editor') ? 'checked' : '' }}>
                            <label for="editor"> Editor</label><br>
                            <input type="checkbox" name="blocked" value="Blocked"
                                {{ $user->hasRole('Blocked') ? 'checked' : '' }}>
                            <label for="blocked"> Blocked</label><br><br>
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    Back
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Content --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-2">
                        <span class="text-xl font-bold">{{ $user->name }}</span>
                        <a class="mx-1" href="{{ route('users.edit', $user->id) }}">
                            <img class="inline" height="20" width="20"
                                src="{{ asset('images/buttons/edit.png') }}" alt="Editar" title="Editar">
                        </a>
                    </div>
                    <div class="mb-2">
                        <span class="font-bold">{{ __('Email') }}:</span>
                        <span>{{ $user->email }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-bold">{{ __('City') }}:</span>
                        <span>{{ $user->city }}</span>
                    </div>
                    <div>
                        <span class="font-bold">{{ __('Phone') }}:</span>
                        <span>{{ $user->phone }}</span>
                    </div>
                    <div>
                        <span class="font-bold">{{ __('Roles') }}:</span>
                        @foreach ($user->roles->pluck('role') as $role)
                            <x-label-tag color="{{ $role == 'Blocked' ? 'red' : 'blue' }}" :text="$role" />
                        @endforeach
                    </div>
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

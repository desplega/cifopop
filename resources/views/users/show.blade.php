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
                    <div class="pb-4 border-b-2 border-gray-300">
                        <span class="text-xl font-bold">{{ $user->name }}</span>
                        <a class="mx-1" href="{{ route('user.edit', $user->id) }}">
                            <img class="inline" height="20" width="20"
                                src="{{ asset('images/buttons/edit.png') }}" alt="Editar" title="Editar">
                        </a>
                    </div>
                    <div class="py-4 border-b-2 border-gray-300">
                        <span class="text-gray-700 font-bold mb-2">{{ __('Email') }}:</span>
                        <span class="text-gray-700">{{ $user->email }}</span>
                    </div>
                    <div class="py-4 border-b-2 border-gray-300">
                        <span class="text-gray-700 font-bold mb-2">{{ __('City') }}:</span>
                        <span class="text-gray-700">{{ $user->city }}</span>
                    </div>
                    <div class="py-4 border-b-2 border-gray-300">
                        <span class="text-gray-700 font-bold mb-2">{{ __('Phone') }}:</span>
                        <span class="text-gray-700">{{ $user->phone }}</span>
                    </div>
                    <div class="py-4 border-b-2 border-gray-300">
                        <span class="text-gray-700 font-bold mb-2">{{ __('Roles') }}:</span>
                        @if ($user->roles->isNotEmpty())
                            @foreach ($user->roles->pluck('role') as $role)
                                <x-label-tag color="{{ $role == 'Blocked' ? 'red' : 'blue' }}" :text="$role" />
                            @endforeach
                        @else
                            {{ __('No roles') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

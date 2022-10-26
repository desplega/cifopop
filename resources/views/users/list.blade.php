<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users list') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Content --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- Content --}}
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase">
                                    {{ __('Name') }}</th>
                                {{-- <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase">
                                    {{ __('Email') }}</th> --}}
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase">
                                    {{ __('City') }}</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase">
                                    {{ __('Phone') }}</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase">
                                    {{ __('Roles') }}</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase">
                                    {{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $user->name }}
                                    </td>
                                    {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $user->email }}
                                    </td> --}}
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $user->city }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $user->phone }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        @foreach ($user->roles->pluck('role') as $role)
                                            <x-label-tag color="{{ $role == 'Blocked' ? 'red' : 'blue' }}"
                                                :text="$role" />
                                        @endforeach
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <a class="inline-block mx-1" href="{{ route('users.show', $user->id) }}">
                                            <img height="20" width="20"
                                                src="{{ asset('images/buttons/show.png') }}" alt="Ver detaller"
                                                title="Ver detalles">
                                        </a>
                                        <a class="inline-block mx-1" href="{{ route('users.edit', $user->id) }}">
                                            <img height="20" width="20"
                                                src="{{ asset('images/buttons/edit.png') }}" alt="Editar"
                                                title="Editar">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

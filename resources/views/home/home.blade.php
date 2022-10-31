<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Adverts') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Content --}}
            @if (null === Auth::user()->email_verified_at)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="text-gray-900 font-bold text-2xl tracking-tight my-4 px-8 dark:text-white">
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <div class="mt-4 flex items-center justify-between">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div>
                                    <x-primary-button>
                                        {{ __('Resend Verification Email') }}
                                    </x-primary-button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            @if (Auth::user()->isBlocked())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="text-red-700 font-bold text-2xl tracking-tight mt-4 px-8 dark:text-white">
                        {{ __('Your user is blocked') }}
                    </div>
                    <div class="text-gray-900 font-bold text-2xl tracking-tight my-4 px-8 dark:text-white">
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Your user has been blocked by the Administrator. You can email the Administrator through the Contact form in the contact section.') }}
                        </div>

                        <a href="{{ route('contact') }}" class="flex items-center justify-end mt-4">
                            <x-primary-button type="button">{{ __('Contact the Administrator') }}</x-primary-button>
                        </a>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="text-gray-900 font-bold text-2xl tracking-tight mt-4 px-8 dark:text-white">
                    {{ __('My data') }}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-my-data :user="Auth::user()" />
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="text-gray-900 font-bold text-2xl tracking-tight mt-4 px-8 dark:text-white">
                    {{ __('Published adverts') }}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap">
                        @forelse ($adverts as $advert)
                            <x-advert-card :advert="$advert" />
                        @empty
                            <p class="px-2">{{ __('No results') }}</p>
                        @endforelse
                    </div>
                    @if ($adverts->hasPages())
                        <div class="mt-4">
                            {{ $adverts->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="text-gray-900 font-bold text-2xl tracking-tight mt-4 px-8 dark:text-white">
                    {{ __('Deleted adverts') }}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap">
                        @forelse ($deleted_adverts as $advert)
                            <x-deleted-advert-card :advert="$advert" />
                        @empty
                            <p class="px-2">{{ __('No results') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

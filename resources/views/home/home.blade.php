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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="text-gray-900 font-bold text-2xl tracking-tight mt-4 px-8 dark:text-white">
                    {{ __('Active Adverts') }}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-advert-card :adverts="$adverts" />
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="text-gray-900 font-bold text-2xl tracking-tight mt-4 px-8 dark:text-white">
                    {{ __('Deleted Adverts') }}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-deleted-advert-card :adverts="$deleted_adverts" />
                </div>
            </div>

            @if ($adverts->hasPages())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 bg-white border-b border-gray-200">
                        {{ $adverts->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

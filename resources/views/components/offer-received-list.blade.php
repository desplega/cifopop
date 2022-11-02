<div class="w-full lg:w-1/3 p-3">
    <div class="bg-white shadow-md border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <div class="p-5">
            <div class="text-gray-900 font-bold text-2xl tracking-tight mb-2 dark:text-white">
                {{ __('ID') . ': #' . $offer->id }}
            </div>
            <p class="font-bold text-gray-700 dark:text-gray-400">
                {{ $offer->title }}</p>
            <p class="font-bold text-gray-700 mb-3 text-center dark:text-gray-400">
                {{ str_replace('.', ',', $offer->price) }} €</p>
            <p class="font-normal text-gray-700 dark:text-gray-400">
                <b>{{ $offer->user_name }}</b> {{ ' ' .  __('says') . ': ' . $offer->text }}
            </p>
            <div class="text-4xl text-gray-600 text-center font-bold my-4">
                {{ str_replace('.', ',', $offer->amount) }} €</div>
            <p class="font-normal text-gray-700 mb-3 dark:text-gray-400">
                <b>{{ __('Due date') }}:
                </b>{{ $offer->due_date ? Custom::formatDate('es', $offer->due_date) : __('No due date') }}
            </p>
            <!-- Actions -->
            <div class="flex justify-end">
                <a class="m-2" href="{{ route('offer.accept', $offer->id) }}"
                    class="flex items-center justify-end mt-4">
                    <x-primary-button type="button">{{ __('Accept') }}</x-primary-button>
                </a>
                <a class="m-2" href="{{ route('offer.reject', $offer->id) }}"
                    class="flex items-center justify-end mt-4">
                    <x-primary-button type="button">{{ __('Reject') }}</x-primary-button>
                </a>
            </div>
        </div>
    </div>
</div>

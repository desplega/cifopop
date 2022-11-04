<div class="w-full lg:w-1/3 p-3">
    <div class="bg-white shadow-md border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <div class="p-5">
            <div class="text-gray-900 font-bold text-2xl tracking-tight mb-2 dark:text-white">
                {{ __('ID') . ': #' . $offer->id }}
            </div>
            <p class="text-gray-700 dark:text-gray-400">
                <b>
                    <a href="{{ route('advert.show', $offer->advert_id) }}" class="hover:underline">
                        {{ $offer->title }}
                    </a>
                </b> ({{ $offer->user_name }})
            </p>
            <p class="font-bold text-gray-700 text-center dark:text-gray-400">
                {{ str_replace('.', ',', $offer->price) }} €</p>
            <div class="text-4xl text-gray-600 text-center font-bold my-4">
                {{ str_replace('.', ',', $offer->amount) }} €</div>
            <p class="font-normal text-gray-700 dark:text-gray-400">
                <b>{{ __('Message') }}: </b>{{ $offer->text }}
            </p>
            <p class="font-normal text-gray-700 mb-3 dark:text-gray-400">
                <b>{{ __('Due date') }}:
                </b>{{ $offer->due_date ? Custom::formatDate('es', $offer->due_date) : __('No due date') }}
            </p>
            <!-- Actions -->
            <div class="flex justify-end">
                @if ($offer->accepted)
                    <div
                        class="px-4 py-2 bg-green-700 rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                        {{ __('Accepted') }}</div>
                @elseif ($offer->rejected)
                    <div
                        class="px-4 py-2 bg-red-700 rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                        {{ __('Rejected') }}</div>
                @else
                    @can('cancel', $offer)
                        <a class="m-2" href="{{ route('offer.cancel', $offer->id) }}"
                            class="flex items-center justify-end mt-4">
                            <x-primary-button type="button">{{ __('Cancel') }}</x-primary-button>
                        </a>
                    @endcan
                @endif
            </div>
        </div>
    </div>
</div>

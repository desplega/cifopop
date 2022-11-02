<div class="w-full lg:w-1/3 p-3">
    <div class="bg-white shadow-md border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <div class="p-5">
            <div class="text-gray-900 font-bold text-2xl tracking-tight mb-2 dark:text-white">
                {{ __('ID') . ': #' . $offer->id }}
            </div>
            <p class="text-gray-700 dark:text-gray-400">
                <b>{{ $offer->title }}</b> {{ ' (' . $offer->user_name . ')' }}</p>
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
        </div>
    </div>
</div>

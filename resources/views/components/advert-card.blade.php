<div class="w-full lg:w-1/2 p-3">
    <div class="bg-white shadow-md border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <div class="m-4 text-right">
            <a class="inline-block mx-1" href="{{ route('advert.edit', $advert->id) }}">
                <img height="20" width="20" src="{{ asset('images/buttons/edit.png') }}" alt="Editar"
                    title="Editar">
            </a>
            <a class="inline-block mx-1" href="{{ route('advert.confirm', $advert->id) }}">
                <img height="20" width="20" src="{{ asset('images/buttons/delete.png') }}" alt="Editar"
                    title="Editar">
            </a>
        </div>
        <img class="m-auto h-60 mt-4"
            src="{{ $advert->image ? asset('storage/' . config('filesystems.advertImagesPath')) . '/' . $advert->image : asset('images/adverts/default.jpg') }}"
            alt="{{ __('Advert ref. :advert', ['advert' => $advert->id]) }}"
            title="{{ __('Advert ref. :advert', ['advert' => $advert->id]) }}">
        <div class="p-5">
            <div class="text-gray-900 font-bold text-2xl tracking-tight mb-2 dark:text-white">
                {{ $advert->title }}
            </div>
            <p class="h-12 overflow-hidden font-normal text-gray-700 mb-3 dark:text-gray-400">
                {{ $advert->description }}</p>
            <div class="text-4xl text-gray-600 text-center font-bold my-4">
                {{ str_replace('.', ',', $advert->price) }} €</div>
            <a href="{{ route('advert.show', $advert->id) }}" class="flex items-center justify-end mt-4">
                <x-primary-button type="button">{{ __('More...') }}</x-primary-button>
            </a>
        </div>
    </div>
</div>

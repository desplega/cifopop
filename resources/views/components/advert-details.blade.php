<div class="flex justify-between">
    <div class="text-gray-900 font-bold text-2xl tracking-tight mb-2 dark:text-white">
        Pepito De los Palotes
    </div>
    <div class="text-gray-900 font-bold text-2xl tracking-tight mb-2 dark:text-white">
        Blanes
    </div>
</div>
<img class="m-auto h-60"
    src="{{ $advert->image ? asset('storage/' . config('filesystems.advertImagesPath')) . '/' . $advert->image : asset('images/adverts/default.jpg') }}"
    alt="{{ __('Advert no. :advert', ['advert' => $advert->id]) }}"
    title="{{ __('Advert no. :advert', ['advert' => $advert->id]) }}">
<div class="p-5">
    <div class="text-gray-900 font-bold text-2xl tracking-tight mb-2 dark:text-white">
        {{ $advert->title }}
    </div>
    <p class="font-normal text-gray-700 mb-3 dark:text-gray-400">
        {{ $advert->description }}</p>
    <div class="text-4xl text-gray-600 text-center font-bold my-4">{{ str_replace('.', ',', $advert->price) }} €
    </div>
    <a href="#" class="flex items-center justify-end mt-4">
        <x-primary-button type="button">{{ __('Make offer') }}</x-primary-button>
    </a>
</div>

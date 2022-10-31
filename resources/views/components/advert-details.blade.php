<div class="flex justify-between">
    <div class="text-gray-900 tracking-tight dark:text-white p-5">
        <div class="block text-2xl font-bold mb-2">
            {{ $advert->user->name }}
        </div>
        <div class="block text-xl">
            {{ $advert->user->city }}
        </div>
    </div>
    <div class="m-4 text-right">
        <a class="inline-block mx-1" href="{{ route('advert.edit', $advert->id) }}">
            <img height="20" width="20" src="{{ asset('images/buttons/edit.png') }}" alt="Editar" title="Editar">
        </a>
        <a class="inline-block mx-1" href="{{ route('advert.delete', $advert->id) }}">
            <img height="20" width="20" src="{{ asset('images/buttons/delete.png') }}" alt="Borrar" title="Borrar">
        </a>
    </div>
</div>
<img class="m-auto h-60"
    src="{{ $advert->image ? asset('storage/' . config('filesystems.advertImagesPath')) . '/' . $advert->image : asset('images/adverts/default.jpg') }}"
    alt="{{ __('Advert ref. :advert', ['advert' => $advert->id]) }}"
    title="{{ __('Advert ref. :advert', ['advert' => $advert->id]) }}">
<div class="p-5">
    <div class="text-gray-900 font-bold text-2xl tracking-tight mb-2 dark:text-white">
        {{ $advert->title }}
    </div>
    <p class="font-normal text-gray-500 mb-3 dark:text-gray-500">
        {{ __('Ref') . ': ' . $advert->id }}
    </p>
    <p class="font-normal text-gray-500 mb-3 dark:text-gray-500">
        {{ $advert->description }}
    </p>
    <div class="text-4xl text-gray-600 text-center font-bold my-4">{{ str_replace('.', ',', $advert->price) }} €
    </div>
    <a href="#" class="flex items-center justify-end mt-4">
        <x-primary-button type="button">{{ __('Make offer') }}</x-primary-button>
    </a>
</div>

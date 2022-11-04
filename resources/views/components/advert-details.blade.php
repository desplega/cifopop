<!-- Advert details -->
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
        @can('update', $advert)
            <a class="inline-block mx-1" href="{{ route('advert.edit', $advert->id) }}">
                <img height="20" width="20" src="{{ asset('images/buttons/edit.png') }}" alt="Editar" title="Editar">
            </a>
        @endcan
        @can('delete', $advert)
            <a class="inline-block mx-1" href="{{ route('advert.delete', $advert->id) }}">
                <img height="20" width="20" src="{{ asset('images/buttons/delete.png') }}" alt="Borrar"
                    title="Borrar">
            </a>
        @endcan
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
    <div class="text-4xl text-gray-600 text-center font-bold my-4">{{ number_format((float)$advert->price, 2, ',', '') }} €
    </div>
    @if ($advert->sold())
        <div class="items-center text-right mt-4">
            <p class="text-gray-500 mb-2">
                {{ __('Sold on') . Custom::formatDate('es', $advert->sold()) }}
            </p>
            <div class="inline-flex px-4 py-2 bg-green-700 rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                {{ __('Sold') }}</div>
        </div>
    @else
        <a href="{{ route('offer.create') . '?advert_id=' . $advert->id }}" class="items-center text-right mt-4">
            @auth
                @if (Auth::user()->id != $advert->user->id &&
                    Auth::user()->getOffer($advert->id) == null &&
                    !strpos(url()->current(), 'offer'))
                    <span class="block">
                        <x-primary-button type="button">{{ __('Make offer') }}</x-primary-button>
                    </span>
                @endif
            @endauth
            @guest
                <p class="mb-2">{{ __('Log in to make an offer') }}</p>
                <span class="block">
                    <x-primary-button type="button">{{ __('Log in') }}</x-primary-button>
                </span>
            @endguest
        </a>
    @endif
</div>

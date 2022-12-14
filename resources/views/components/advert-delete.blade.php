<img class="m-auto h-60 mt-4"
    src="{{ $advert->image ? asset('storage/' . config('filesystems.advertImagesPath')) . '/' . $advert->image : asset('images/adverts/default.jpg') }}"
    alt="{{ __('Advert ref. :advert', ['advert' => $advert->id]) }}"
    title="{{ __('Advert ref. :advert', ['advert' => $advert->id]) }}">
<div class="p-5">
    <div class="text-gray-900 font-bold text-2xl tracking-tight mb-2 dark:text-white">
        <a href="{{ route('advert.show', $advert->id) }}" class="hover:underline">
            {{ $advert->title }}
        </a>
    </div>
    <p class="h-12 overflow-hidden font-normal text-gray-700 mb-3 dark:text-gray-400">
        {{ $advert->description }}</p>
    <div class="text-4xl text-gray-600 text-center font-bold my-4">
        {{ number_format((float)$advert->price, 2, ',', '') }} €</div>
    <div class="items-center text-right mt-4">
        <p class="text-red-700 mb-2">
            {{ $advert->deleted_at
                ? __('Are you sure you want to permanently delete this advert?')
                : __('Are you sure you want to delete this advert (it can be restored later)?') }}
        </p>
        <form class="block" method="POST"
            action="{{ route($advert->deleted_at ? 'advert.purge' : 'advert.destroy', $advert->id) }}">
            @csrf
            @method('DELETE')
            <x-primary-button type="submit">{{ __('Confirm') }}</x-primary-button>
        </form>
    </div>
</div>

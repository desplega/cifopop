<img class="block h-auto w-full lg:w-48 flex-none bg-cover"
    src="{{ $advert->image ? asset('storage/' . config('filesystems.advertImagesPath')) . '/' . $advert->image : asset('images/adverts/default.jpg') }}">
<div class="bg-white p-4">
    <div class="text-black font-bold text-xl mb-2 leading-tight">{{ $advert->title }}</div>
    <div class="text-grey-darker text-base  ">
        {{ $advert->description }}</div>
    {{-- <p class="text-grey-darker text-base">{{ __('Advert no.: ') . $advert->id }}</p> --}}
    <div class="block my-2 text-3xl text-bold text-orange-700">{{ str_replace('.', ',', $advert->price) }} €
    </div>
    <a class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
        href="#" role="button">{{ __('Make offer') }}</a>
</div>

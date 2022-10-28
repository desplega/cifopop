<div class="flex flex-wrap">
    @foreach ($adverts as $advert)
        <div class="w-full lg:w-1/2 p-3">
            <div class="flex flex-col lg:flex-row-reverse rounded border shadow-lg">
                <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"
                    style="background-image: url({{ $advert->image ? asset('storage/' . config('filesystems.advertImagesPath')) . '/' . $advert->image : asset('images/adverts/default.jpg') }})"
                    title="{{ __('Advert no. :advert', ['advert' => $advert->id]) }}">
                </div>
                <div class="bg-white p-4">
                    <div class="text-black font-bold text-xl mb-2 leading-tight">{{ $advert->title }}</div>
                    <div class="text-grey-darker text-base overflow-hidden lg:h-16 h-auto leading-tight">
                        {{ $advert->description }}</div>
                    {{-- <p class="text-grey-darker text-base">{{ __('Advert no.: ') . $advert->id }}</p> --}}
                    <div class="block my-2 text-3xl text-bold text-orange-700">
                        {{ str_replace('.', ',', $advert->price) }} €</div>
                    <a class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                        href="{{ route('advert.show', $advert->id) }}" role="button">{{ __('More...') }}</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

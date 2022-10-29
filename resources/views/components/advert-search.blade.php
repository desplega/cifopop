<form method="GET" action="{{ route('advert.search') }}" class="flex justify-between">
    <div class="w-full mr-4">
        <x-input-label for="title" :value="__('Title')" />
        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" maxlength="16"
            :value="$title" />
    </div>

    <div class="w-full mr-4">
        <x-input-label for="description" :value="__('Description')" />
        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" maxlength="16"
            :value="$description" />
    </div>

    <div class="mt-8">
        <x-primary-button class="mr-4">{{ __('Search') }}</x-primary-button>
    </div>

    <a class="mt-8" href="{{ route('advert.index') }}">
        <x-primary-button type="button">{{ __('Clear') }}</x-primary-button>
    </a>
</form>

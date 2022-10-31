<div class="flex flex-wrap">
    <div class="p-5 grow">
        <div class="text-gray-900 font-bold text-xl tracking-tight mb-1">
            {{ $user->name }} 
        </div>
        <div class="text-gray-700">
            {{ $user->email }}
        </div>
        <div class="text-xl mt-4">
            {{ $user->city }}
        </div>
    </div>
    <div class="p-5 grow">
        <div class="text-gray-900 font-bold text-xl tracking-tight mb-1">
            {{ __('Published adverts') }}:
            <span class="text-xl font-normal">{{ $user->adverts->count() }}</span>
        </div>
        <div class="text-gray-900 font-bold text-xl tracking-tight mb-1">
            {{ __('Deleted adverts') }}:
            <span class="text-xl font-normal">{{ $user->adverts()->onlyTrashed()->count() }}</span>
        </div>
    </div>
</div>

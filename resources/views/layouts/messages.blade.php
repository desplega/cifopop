@if (Session::has('success'))
    <x-alert color="green" message="{{ Session::get('success') }}" />
@endif

@if ($errors->any())
    <x-alert color="red" message="{{ __('Please check the value of the following fields:') }}">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

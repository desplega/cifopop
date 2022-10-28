@if (Session::has('success'))
    <x-alert color="green" message="{{ Session::get('success') }}" />
@endif

@if (Session::has('error'))
    <x-alert color="red" message="{{ Session::get('error') }}" />
@endif

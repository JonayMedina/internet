@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Bienvenido a {{ config('app.name') }}
        @endcomponent
    @endslot

    # Hola {{ $customer->name }}!. Felicidades se ha registrado su contrato.

    Se ha registrado su servicio {{ $plan->name}}, el cual tiene un costo mensual de {{ $plan->cost }}$

    Le adjuntamos el Contrato con numero {{ $contract->id }} y las condiciones de Servicio.

    Gracia por preferirnos, atte. El Equipo de:

    {{ config('app.name') }}
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent

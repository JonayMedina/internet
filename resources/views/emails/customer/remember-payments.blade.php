@component('mail::message')
# Hola esperamos te encuentres bien.
	Te escribimos para recordarte que estamos ha 5 dias de tu fecha para el Pago de servicio {{ $contract->plan->name}}, con un Monto de {{ $contract->plan->name}}.

@component('mail::button', ['url' => $url])
Vamos!. Confirma tu Pago.
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent

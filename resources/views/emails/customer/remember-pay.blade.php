@component('mail::message')
# Hola esperamos te encuentres bien.
	Tenemos tiempo sin saber de ti, por eso te enviamos este email es para recordarle que se encuentra atrasado en el Pago de servicio {{ $customer->contract->plan->name}} con un Monto de {{ $customer->contract->contract_amount}}.

@component('mail::button', ['url' => $url])
Vamos!. Confirma tu Pago.
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent

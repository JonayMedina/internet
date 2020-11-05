<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentRemember extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;
    public $url;

    public function __construct($contract)
    {
        $this->contract = $contract;
        $this->url = route('pay-report');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.customer.remember-payments')
                    ->subject('Recodatorio 5 dias para su fecha de pago Servicios Cnet');
    }
}

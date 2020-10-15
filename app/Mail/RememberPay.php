<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RememberPay extends Mailable
{
    use Queueable, SerializesModels;
    public $customer;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer)
    {
        $this->customer = $customer;
        $this->url = route('pay-report');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.customer.remember-pay')
                    ->subject('Recordatorio de Pago de Servicios Cnet');
    }
}

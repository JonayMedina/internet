<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerContract extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $contract;
    public $plan;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contract,$customer,$pdf)
    {
        $this->contract = $contract;
        $this->plan = $contract->plan;
        $this->customer = $customer;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.customer.contract')
                    ->subject('Contrato de Servicios')
                    ->attachData($this->pdf,'Contrato de Servicio n° '.$this->contract->id.'.pdf', [
                            'mime' => 'application/pdf',
                        ]);
    }
}

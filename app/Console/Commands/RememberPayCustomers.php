<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\PaymentRemember;
use App\Models\Customer;
use App\Models\Contract;
use Carbon\Carbon;
use Mail;

class RememberPayCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rememberpay:customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recordatorio de pago A Clientes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $day = Carbon::today()->add(5,'day');
        $contracts = Contract::where('active', 1)->whereDay('contract_date', $day)->with(['customer:id,name,email','plan:id,name,cost'])->get();

        for ($i=0; $i <count($contracts) ; $i++) {
            Mail::to($contracts[$i]->customer->email)->send(new PaymentRemember($contracts[$i]));
        }

    }
}

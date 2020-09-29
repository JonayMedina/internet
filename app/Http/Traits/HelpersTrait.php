<?php

namespace Traits;

use PDF;
use App\Models\Customer;
use App\Models\Contract;
use App\Models\Plan;

trait HelpersTrait {

    public function contractPdf($id)
    {
        $contract = Contract::with('plan:id,name,cost')->find($id);

        $customer = $contract->customer();

        $pdf = PDF::loadView('pdf.contract',[
            'contract' => $contract,
            'customer' => $customer,
            'image' => '',
        ])->stream('Contrato de servicio n° '. $contract->id.'.pdf');
        return $pdf;
    }

    public static function contract($id)
    {
        $contract = Contract::with('plan:id,name,cost')->find($id);

        $customer = $contract->customer();
        // $customer = Customer::where('id',$contract->customer_id);

        $pdf = PDF::loadView('pdf.contract',[
            'contract' => $contract,
            'customer' => $customer,
            'image' => '',
        ])->stream('Contrato de servicio n° '. $contract->id.'.pdf');
        return $pdf;
    }
}

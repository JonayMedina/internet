<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Mail;
use Traits\HelpersTrait;
use App\Models\Customer;
use App\Models\Plan;
use App\Models\Contract;
use App\Mail\CustomerContract;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use HelpersTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return response()->json(['customers' => $customers]);
    }

    public function search(Request $request)
    {
        $customer = Customer::where('dni', $request->dni)->with('contract:customer_id,id,plan_id')->first();
        if (!$customer) {
            return response()->json(['error'=>'Esta cedula no se encuentra en nuestros registros. Verifique y consulte de nuevo.'], 404);
        }
        $contract = $customer->contract;
        $plan = Plan::select('name','cost')->find($customer->contract->plan_id);
        return response()->json(['customer'=>$customer, 'contract'=> $contract, 'plan'=>$plan]);
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();
            $customer = new Customer([
                'name' => $request->name,
                'dni' => $request->dni,
                'phone' => $request->phone,
                'email' => $request->email,
                'active' => 1,
            ]);

            $customer->save();

            if ($request->plan_id) {
                $plan = Plan::find($request->plan_id);
                $contract = new Contract([
                    'customer_id' => $customer->id,
                    'contract_date' => $request->billing_date,
                    'plan_id' => $request->plan_id,
                    'contract_amount' => $plan->cost,
                    'notes' => $request->notes
                ]);

                $contract->save();
            }

            DB::commit();

            $this->contractEmail($customer, $contract);
            // return $customer;
            return response()->json(['message'=>'Cliente Guardado', 'customer'=>$customer]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error'=>$e], 400);
        }

    }

    public function show($id)
    {
        $customer = Customer::find($id);
        return response()->json(['customer'=>$customer]);
    }


    public function edit($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $customer = Customer::findOrFail($id);
        // dd($request);
        $customer->update($request->all());

        return response()->json(['message'=>'Cliente actualizado']);
    }

    public function desactive(Request $request)
    {
        $customer = Customer::find($request->id);
        $customer->active = 0;
        $customer->save();

        return response()->json(['message'=>'desactivado']);
    }

    public function activate(Request $request)
    {
        $customer = Customer::find($request->id);
        $customer->active = 1;
        $customer->save();

        return response()->json(['message' => 'activado']);
    }


    public function destroy($id)
    {
        $customer = Customer::findOrFail($id)->delete();

        return response()->json(['message' => 'Eliminado']);
    }

    public function emailV($email)
    {
        $e = Customer::where('email', $email)->first();
        return response()->json(['email'=>$e]);
    }

    public function dniV($dni)
    {
        $d = Customer::where('dni', $dni)->first();
        return response()->json(['dni'=>$d]);
    }

    public function phoneV($phone)
    {
        $p = Customer::where('phone', $phone)->first();
        return response()->json(['phone'=>$p]);
    }

    public function totalCalculate()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $customers = Customer::all();
        $totalSale = [];
        $total = 0;

        for ($c=0; $c <count($customers); $c++) {
            $amount = Sale::where('customer_id', $customers[$c]->id)->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->sum('amount');

            if ($amount != '') {
                Customer::where('id', $customers[$c]->id)->update([ 'accumulated' => $amount ]);
                $total = $total + $amount;
                $arr = array_push($totalSale, ['customer_id' => $customers[$c]->id, 'amount' => $amount]);
            }

        }

        return response()->json(['totalrray'=>$totalSale, 'amount' => $total ], 200);
    }

    public function contractEmail($customer, $contract)
    {
        $pdf = $this->contractPdf($contract->id);
        Mail::to($customer)->send(new CustomerContract($contract,$customer,$pdf));

        return 'true';
    }


}

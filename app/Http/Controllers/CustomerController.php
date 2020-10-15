<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Mail;
use Traits\HelpersTrait;
use App\Models\Customer;
use App\Models\Plan;
use App\Models\Contract;
use App\Models\Payment;
use App\Mail\CustomerContract;
use App\Mail\RememberPay;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use HelpersTrait;

    public function index()
    {
        // $customers = Customer::with(['contract:customer_id,contract_num','plan:id,name'])->get();

        $customers = Customer::with(['contract'=> function ($query) {
                $query->with('plan:id,name')->get();
            }])->get();
        return response()->json(['customers' => $customers->toArray()]);
    }

    public function indexCount()
    {
        $customers = Customer::count();
        return response()->json(['customers' => $customers]);
    }

    public function search(Request $request)
    {
        $customer = Customer::where('dni', $request->dni)->with('contract:customer_id,id,contract_num,plan_id')->first();
        if (!$customer) {
            return response()->json(['error'=>'Esta cedula no se encuentra en nuestros registros. Verifique y consulte de nuevo.'], 404);
        }
        $contract = $customer->contract;
        $plan = Plan::select('id','name','cost')->find($customer->contract->plan_id);
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
                $c = Contract::select('id')->orderBy('id','desc')->first();
                $c_id = $c->id+1;
                $contract = new Contract([
                    'contract_num' => 'CN#-'.str_pad($c_id, 10, "0", STR_PAD_LEFT),
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

    public function update(Request $request,$id)
    {
        $customer = Customer::findOrFail($id);

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

    public function rememberPay(Customer $customer)
    {   
        // dd($customer->contract->plan->name);
        Mail::to($customer)->send(new RememberPay($customer));

        return response()->json(['message' => 'Mensaje Enviado a: '.$customer->name]);
    }

    public function contractEmail($customer, $contract)
    {
        $pdf = $this->contractPdf($contract->id);
        Mail::to($customer)->send(new CustomerContract($contract,$customer,$pdf));

        return 'true';
    }


}

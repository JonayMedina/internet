<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::today()->subDays(63);
        $payments = Payment::where('created_at', '>=', $date)->with(['customer:id,name', 'bank:id,name'])->get()->reverse();

        return response()->json(['charges' => $payments]);
    }

    public function indexCount()
    {
        $date = Carbon::today()->subDays(31);
        $payments = Payment::where('created_at', '>=', $date)->count();
        return response()->json(['charges' => $payments]);
    }

    public function indexHistory()
    {
        $payments = Payment::with(['customer:id,name', 'bank:id,name'])->get()->reverse();

        return response()->json(['charges' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $payment = new Payment([
                'amount' => $request->amount,
                'payment_num' => $request->num,
                'payment_date' => Carbon::createFromFormat('Y-m', $request->date),
                'payment_type' => $request->type,
                'customer_id' => $request->customer_id,
                'bank_id' => $request->bank_id,
                'billing_id' => $request->billing_id,
                'active' => 0
            ]);

            $payment->save();

            DB::commit();

            return response()->json(['message'=> 'Pago Guardado'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error'=>$e], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update($request->all());

        return response()->json(['message' => 'Actualizado'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function desactive(Request $request)
    {
        $payment = Payment::find($request->id);
        $payment->active = 0;
        $payment->save();

        return response()->json(['message' => 'El pago ha sido Desactivado'], 201);
    }

    public function activate($id)
    {
        $payment = Payment::find($id);
        $payment->active = 1;
        $payment->save();

        return response()->json(['message' => 'El pago ha sido Activado'], 201);
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id)->delete();
        return response()->json(['message' => 'El pago ha sido Eliminado'], 201);
    }
}

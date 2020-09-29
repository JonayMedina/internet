<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::orderBy('id', 'desc')->get();
        return response()->json(['banks'=>$banks]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bank = new Bank([
            'name' => $request->name,
            'account_number' => $request->account_number,
            'holder' => $request->holder,
            'active' => 1,
        ]);
        $bank->save();

        return response()->json(['message'=>'Cuenta Guardada']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $bank
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bank = Bank::find($id);
        return response()->json(['bank'=>$bank]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank = Bank::find($id);
        return response()->json(['bank'=>$bank]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $bank = Bank::findOrFail($id);
        $bank->update($request->all());

        return response()->json(['message'=>'Datos actualizados']);
    }

    public function desactive($id)
    {
        $bank = Bank::find($id);
        $bank->active = 0;
        $bank->save();

        return response()->json(['message'=>'Cuenta desactivada']);
    }

    public function activate($id)
    {
        $bank = Bank::find($id);
        $bank->active = 1;
        $bank->save();

        return response()->json(['message'=>'Cuenta activa']);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();

        return response()->json(['message'=>'Eliminada']);
    }
}

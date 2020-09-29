<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::all();
        return response()->json(['plans' => $plans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $plan = new Plan([
              'name' => $request->name,
              'download' => $request->download,
              'upload' => $request->upload,
              'unit_dw' => $request->unit_dw,
              'unit_up' => $request->unit_up,
              'cost' => $request->cost,
              'description' => $request->description,
              'active' => 1
            ]);

            $plan->save();
            DB::commit();
            return response()->json(['message'=>'Plan Registrado']);
        } catch (Excepction $e) {
            DB::rollBack();
            return response()->json(['error'=>$e], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return response()->json(['plan'=> $plan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name' => 'required|string',
            'download' => 'required|numeric',
            'upload' => 'required|numeric',
            'unit_dw' => 'required|string',
            'unit_up' => 'required|string',
            'cost' => 'required'
        ]);

        $plan->update($request->all());

        return response()->json(['message' => 'Plan Actualizado']);

    }

    public function desactive($id)
    {
        $plan = Plan::find($id);
        $plan->active = 0;
        $plan->save();

        return response()->json(['message' => 'desactivado']);
    }

    public function activate($id)
    {
        $plan = Plan::find($id);
        $plan->active = 1;
        $plan->save();

        return response()->json(['message' =>'Plan Activo!']);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id)->delete();
        return response()->json(['message' =>'Plan Eliminado con Exito!']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function equipmentLost() {
        $lostEquipments = Equipment::with([
            'template',
            ])->where('status', 0)->get();
        $recentOrderInfos = [];
        foreach($lostEquipments as $lostEquipment) {
            $recentOrderInfos[$lostEquipment->id] = $lostEquipment->getRecentOrderInfo();
        }
        return view('equipment-lost')->with([
            'lostEquipments' => $lostEquipments,
            'recentOrderInfos' => $recentOrderInfos
        ]);
    }
    public function receivedLostEquipment(Request $request, Equipment $equipment) {
        $recentOrderInfos = $request->input('recentOrderInfos');
        $equipment->update([
            'status' => 1,
            'condition' => $recentOrderInfos['condition_received']
        ]);
        return $equipment;
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
        Equipment::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Equipment::find($id)->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Equipment::find($id)->delete();
        return redirect()->back();
    }
}

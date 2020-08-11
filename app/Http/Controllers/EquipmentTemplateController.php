<?php

namespace App\Http\Controllers;

use App\EquipmentTemplate;
use Illuminate\Http\Request;
use App\Equipment;

class EquipmentTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipmentTemplates = EquipmentTemplate::all();
        return $equipmentTemplates;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('request-test');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $template = new EquipmentTemplate($request->all());
        return $equipmentTemplates;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EquipmentTemplate  $equipmentTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentTemplate $equipmentTemplate)
    {
        $equipments = $equipmentTemplate->equipments;
        return view('request-test')->with([
            'equipmentTemplate' => $equipmentTemplate,
            'equipments' => $equipments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EquipmentTemplate  $equipmentTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentTemplate $equipmentTemplate)
    {
        return view('request-test')->with([
            'equipmentTemplate' => $equipmentTemplate
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EquipmentTemplate  $equipmentTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipmentTemplate $equipmentTemplate)
    {
        $equipmentTemplate->update([
            'name' => 'Sony Bravia'
        ]);
        $equipmentTemplate->update($request->all());
        return redirect(route('equipment-template.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EquipmentTemplate  $equipmentTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentTemplate $equipmentTemplate)
    {
        $equipmentTemplate->delete();
        return redirect(route('equipment-template.index'));
    }
}

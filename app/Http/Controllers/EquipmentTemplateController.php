<?php

namespace App\Http\Controllers;

use App\EquipmentTemplate;
use Illuminate\Http\Request;
use App\Equipment;
use App\Category;

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
        $categories = Category::all();
        return view('equipment')->with([
            'equipmentTemplates' => $equipmentTemplates,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('create-equipment')->with([
            'categories' => $categories,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('imageFile')) {
            $fileName = $request->imageFile->getClientOriginalName();
            $request->imageFile->storeAs('img', $fileName, 'public');
            $template = new EquipmentTemplate($request->all());
            $template->save();
            $template->update(['image' => $fileName]);
        } else {
            $template = new EquipmentTemplate($request->all());
            $template->save();
        }
        
        return redirect(route('equipment-template.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EquipmentTemplate  $equipmentTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentTemplate $equipmentTemplate)
    {
        return view('equipment-detail')->with([
            'equipmentTemplate' => $equipmentTemplate,
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
        // dd($equipmentTemplate);
        $equipmentTemplate->delete();
        return redirect()->back();
    }
}

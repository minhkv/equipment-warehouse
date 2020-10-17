<?php

namespace App\Http\Controllers;

use App\EquipmentTemplate;
use Illuminate\Http\Request;
use App\Equipment;
use App\Category;
use App\Supplier;
use Exception;

class EquipmentTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipmentTemplates = EquipmentTemplate::with('equipments')
        ->where('display', 1)
        ->get();
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
        $suppliers = Supplier::all();
        return view('create-equipment')->with([
            'categories' => $categories,
            'suppliers' => $suppliers,
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
        try {
            $template = new EquipmentTemplate($request->all());
            $template->save();
            $equipments = json_decode($request->equipments);
            
            if($request->hasFile('imageFile')) {
                $fileName = $request->imageFile->getClientOriginalName();
                $request->imageFile->storeAs('img', $fileName, 'public');
                $template->update(['image' => '/storage/img/'.$fileName]);
            } else {
                $template->update(['image' => '/storage/img/empty.jpg']);
            }
            if($equipments) {
                foreach($equipments as $equipment) {
                    $equipment = (array) $equipment;
                    $template->equipments()->create($equipment);
                }
            }
            return $template;
        } catch(Exception $e) {
            return json_encode((object) ['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EquipmentTemplate  $equipmentTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentTemplate $equipmentTemplate)
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        $equipmentTemplate->load([
            'category',
            'equipments',
            'equipments.supplier',
            'equipments.orderInfos',
            'equipments.orderInfos.orderRequestInfo.order'
            ]);
        return view('equipment-detail')->with([
            'equipmentTemplate' => $equipmentTemplate,
            'suppliers' => $suppliers,
            'categories' => $categories
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
        $equipmentTemplate->update($request->all());        
        if($request->hasFile('imageFile')) {
            $fileName = $request->imageFile->getClientOriginalName();
            $request->imageFile->storeAs('img', $fileName, 'public');
            $equipmentTemplate->update(['image' => '/storage/img/'.$fileName]);
        } 
        return $equipmentTemplate->load(['category']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EquipmentTemplate  $equipmentTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentTemplate $equipmentTemplate)
    {
        $equipmentTemplate->update(['display' => 0]);
        return EquipmentTemplate::where('display', 1)
        ->with('equipments')->get();
    }
}

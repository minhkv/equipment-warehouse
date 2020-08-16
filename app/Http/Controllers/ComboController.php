<?php

namespace App\Http\Controllers;

use App\Combo;
use Illuminate\Http\Request;
use App\Equipment;
use App\EquipmentTemplate;
use App\ComboInfo;

class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $combos = Combo::all();
        return view('combo')->with([
            'combos' => $combos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipmentTemplates = EquipmentTemplate::all();
        return view('create-combo')->with([
            'equipmentTemplates' => $equipmentTemplates
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
        $combo = Combo::create([
            'name' => $request->input('name')
        ]);
        $templates = json_decode($request->input('templates')[0]);
        foreach($templates as $template) {
            $combo->comboInfos()->create([
                'template_id' => $template->id,
                'amount' => $template->amount
            ]);            
        }
        return redirect(route('combo.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function show(Combo $combo)
    {
        $selectedTemplates = [];
        foreach($combo->comboInfos as $info) {
            $selectedTemplates[] = $info->template;
        }
        $equipmentTemplates = EquipmentTemplate::all();
        return view('combo-detail')->with([
            'combo' => $combo,
            'equipmentTemplates' => $equipmentTemplates,
            'selectedTemplates' => $selectedTemplates
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function edit(Combo $combo)
    {
        return view('combo-detail', compact($combo));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Combo $combo)
    {
        $infos = $request->input('comboInfos');
        foreach($infos as $info) {
            ComboInfo::find($info['id'])->update($info);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Combo $combo)
    {
        $combo->delete();
        return redirect()->back();
    }
}

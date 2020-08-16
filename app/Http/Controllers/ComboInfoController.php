<?php

namespace App\Http\Controllers;

use App\ComboInfo;
use Illuminate\Http\Request;

class ComboInfoController extends Controller
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
        ComboInfo::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ComboInfo  $comboInfo
     * @return \Illuminate\Http\Response
     */
    public function show(ComboInfo $comboInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ComboInfo  $comboInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ComboInfo $comboInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ComboInfo  $comboInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComboInfo $comboInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ComboInfo  $comboInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComboInfo $comboInfo)
    {
        $comboInfo->delete();
    }
}

<?php

namespace App\Http\Controllers;

use App\Order;
use App\Channel;
use App\User;
use App\EquipmentTemplate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DateTime;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('order')->with([
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $equipmentTemplates = EquipmentTemplate::all();
        $channels = Channel::all();
        $stocker_id = Auth::user()->id;
        return view('create-order')->with([
            'users' => $users,
            'channels' => $channels,
            'equipmentTemplates' =>$equipmentTemplates,
            'stocker_id' => $stocker_id
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
        $order = Order::create([
            'type' => $request->input('type'),
            'stocker_id' => $request->input('stocker_id'),
            'guest_id' => $request->input('guest_id'),
            'reason' => $request->input('reason'),
            'status' => '0',
        ]);
        $templates = json_decode($request->input('templates')[0]);
        // foreach($templates as $template) {
        //     $order->orderRequestInfos()->create([
        //         'template_id' => $template->id,
        //         'amount' => $template->amount,
        //     ]);            
        // }
        return redirect(route('order.index'));
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('order-detail')->with([
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back();
    }

    public function storeRequest(Request $request) {
        $order = Order::create([
            'type' => $request->input('type'),
            'stocker_id' => $request->input('stocker_id'),
            'guest_id' => $request->input('guest_id'),
            'reason' => $request->input('reason'),
            'status' => '0',
        ]);
        $templates = json_decode($request->input('templates')[0]);
        foreach($templates as $template) {
            $order->orderRequestInfos()->create([
                'template_id' => $template->id,
                'amount' => $template->amount,
            ]);            
        }
        return redirect(route('order.index'));
    }

    public function acceptOrderRequest(Order $order) {

    }
    
    public function rejectOrderRequest(Order $order) {

    }
}

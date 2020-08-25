<?php

namespace App\Http\Controllers;

use App\Order;
use App\Channel;
use App\User;
use App\EquipmentTemplate;
use App\Equipment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with([
            'orderRequestInfos', 
            'orderRequestInfos.orderInfos', 
            'guest'
            ])->orderBy('created_at', 'DESC')->get();
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
        $equipmentTemplates = EquipmentTemplate::with(['equipments'])->get();
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
        $selectedTemplates = [];
        $order->orderRequestInfos->load([
            'template', 
            'orderInfos', 
            'orderInfos.equipment',
            'template.equipments',
            'template.equipments.supplier',
            ]);
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
        return redirect(route('order.show', $order));
    }

    public function back(Order $order) {
        if($order->status < 2 || $order->status > 3) {
            return 'Order status must be 2 or 3';
        }
        foreach($order->orderRequestInfos as $orderRequestInfo) {
            foreach($orderRequestInfo->orderInfos as $orderInfo) {
                if($order->status == 2) {
                    $orderInfo->equipment->update([
                        'status' => 1
                        ]);
                } 
                // else {
                //     $orderInfo->equipment->update([
                //         'status' => 2
                //     ]);
                // }
            }
        }
        $order->update([
            'status' => $order->status - 1
            ]);
        
        return $order->load([
            'orderRequestInfos', 
            'orderRequestInfos.orderInfos', 
            'orderRequestInfos.orderInfos.equipment'
            ]);
    }



    public function acceptOrderRequest(Order $order) {
        $order->update([
            'status' => 1,
            'date_approved' => date('Y-m-d H:i:s')
            ]);
        return 'accept';
    }
    
    public function rejectOrderRequest(Order $order) {
        $order->update(['status' => -1]); //reject
        return 'reject';
    }

    public function equipmentOutput(Request $request, Order $order) {
        $templateBorrowedAmount = $request->input('templateBorrowedAmount');
        $orderRequestInfos = $request->input('orderRequestInfos');
        $order->update([
            'status' => 2, //output
            'date_output' => date('Y-m-d H:i:s')
            ]);
        foreach($order->orderRequestInfos as $orderRequestInfoModel) {
            $template_id = $orderRequestInfoModel->template_id;
            $orderRequestInfoModel->update([
                'borrowed_amount' => $templateBorrowedAmount[$template_id]
            ]);
            if($orderRequestInfoModel->orderInfos->count() > 0) {
                $orderRequestInfoModel->orderInfos()->delete();
            }
            foreach($orderRequestInfos[$template_id]['order_infos'] as $orderInfo){
                Equipment::where('id', $orderInfo['equipment_id'])->update([
                    'status' => 2
                ]);
                $orderRequestInfoModel->orderInfos()->create([
                    'equipment_id' => $orderInfo['equipment_id']
                ]);
            }
        }
        return "equipmentOutput";
    }

    public function equipmentReturn(Request $request, Order $order) {
        $orderRequestInfos = $request->input('orderRequestInfos');
        $order->update([
            'status' => 3, //returnEquipment
            'date_received' => date('Y-m-d H:i:s')
            ]);
        foreach($order->orderRequestInfos as $orderRequestInfoModel) {
            $template_id = $orderRequestInfoModel->template_id;
            foreach($orderRequestInfos[$template_id]['order_infos'] as $orderInfo){
                $orderRequestInfoModel->orderInfos()->where('id', $orderInfo['id'])->update([
                    'status' => $orderInfo['status'],
                    'condition_received' => $orderInfo['condition_received']
                ]);
            }
        }
        return 'equipmentReturn';
    }

    public function completeOrder(Request $request, Order $order) {
        $orderRequestInfos = $request->input('orderRequestInfos');
        $order->update([
            'status' => 4, //complete
            ]);
            foreach($order->orderRequestInfos as $orderRequestInfoModel) {
                $template_id = $orderRequestInfoModel->template_id;
                foreach($orderRequestInfos[$template_id]['order_infos'] as $orderInfo){
                    Equipment::where('id', $orderInfo['equipment_id'])->update([
                        'status' => $orderInfo['status'],
                        'condition' => $orderInfo['condition_received']
                    ]);
                }
            }
        return 'orderCompleted';
    }
}

<?php

namespace App\Http\Controllers;

use App\Order;
use App\Channel;
use App\User;
use App\EquipmentTemplate;
use App\Equipment;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        $categories = Category::all();
        return view('create-order-multi')->with([
            'users' => $users,
            'channels' => $channels,
            'equipmentTemplates' =>$equipmentTemplates,
            'stocker_id' => $stocker_id,
            'categories' => $categories
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
        $order->load(['guest']);
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
        // return $request->input('longTerm') ? 1 : 0;
        $order = Order::create([
            'type' => $request->input('type'),
            'stocker_id' => $request->input('stockerId'),
            'guest_name' => $request->input('guestName'),
            'department' => $request->input('department'),
            'date_borrowed' => $request->input('dateBorrowed'),
            'date_return' => $request->input('dateReturn'),
            'long_term' => $request->input('longTerm') ? 1 : 0,
            'reason' => $request->input('reason'),
            'status' => '0',
        ]);
        $templates = ($request->input('templates'));
        foreach($templates as $template) {
            $order->orderRequestInfos()->create([
                'template_id' => $template['id'],
                'amount' => $template['amount'],
            ]);            
        }
        return (route('order.show', $order));
    }

    public function back(Order $order) {
        if($order->status < 1 || $order->status > 3) {
            return 'Order status must be 1, 2 or 3';
        }
        if($order->status > 1) {
            foreach($order->orderRequestInfos as $orderRequestInfo) {
                foreach($orderRequestInfo->orderInfos as $orderInfo) {
                    if($order->status == 2) {
                        $orderInfo->equipment->update([
                            'status' => 1
                            ]);
                    } 
                }
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



    public function acceptOrderRequest(Request $request, Order $order) {
        $dateApproved = date_create($request->input('dateApproved'));
        
        $order->update([
            'status' => 1,
            'date_approved' => date_format($dateApproved, 'Y-m-d H:i:s')
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
        $dateOutput = date_create($request->input('dateOutput'));

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
                    'equipment_id' => $orderInfo['equipment_id'],
                    'condition_before' => $orderInfo['condition_before'],
                ]);
            }
        }
        $order->update([
            'status' => 2, //output
            'date_output' => date_format($dateOutput, 'Y-m-d H:i:s')
            ]);
        return "equipmentOutput";
    }

    public function equipmentReturn(Request $request, Order $order) {
        $orderRequestInfos = $request->input('orderRequestInfos');
        $dateReturn = date_create($request->input('dateReturn'));
        
        foreach($order->orderRequestInfos as $orderRequestInfoModel) {
            $template_id = $orderRequestInfoModel->template_id;
            foreach($orderRequestInfos[$template_id]['order_infos'] as $orderInfo){
                $orderRequestInfoModel->orderInfos()->where('id', $orderInfo['id'])->update([
                    'status' => $orderInfo['status'],
                    
                    'note' => $orderInfo['note'],
                ]);
                if($orderInfo['status'] != 0) {
                    $orderRequestInfoModel->orderInfos()->where('id', $orderInfo['id'])->update([
                        'condition_received' => $orderInfo['condition_received']
                    ]);
                }
            }
        }
        $order->update([
            'status' => 3, //returnEquipment
            'date_received' => date_format($dateReturn, 'Y-m-d H:i:s')
            ]);
        return 'equipmentReturn';
    }

    public function completeOrder(Request $request, Order $order) {
        $orderRequestInfos = $request->input('orderRequestInfos');
        $dateCompleted = date_create($request->input('dateCompleted'));
        
        foreach($order->orderRequestInfos as $orderRequestInfoModel) {
            $template_id = $orderRequestInfoModel->template_id;
            foreach($orderRequestInfos[$template_id]['order_infos'] as $orderInfo){
                Equipment::where('id', $orderInfo['equipment_id'])->update([
                    'status' => $orderInfo['status'],
                    'condition' => $orderInfo['condition_received'],
                    'note' => $orderInfo['note']
                ]);
            }
        }
        $order->update([
            'status' => 4, //complete
            'date_completed' => date_format($dateCompleted, 'Y-m-d H:i:s')
            ]);
        return 'orderCompleted';
    }
}

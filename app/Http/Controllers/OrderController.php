<?php

namespace App\Http\Controllers;

use App\Order;
use App\Department;
use App\User;
use App\EquipmentTemplate;
use App\Equipment;
use App\Category;
use App\OrderInfo;
use App\OrderRequestInfo;
use App\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Exception;

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
            'orderRequestInfos.template.equipments', 
            'stocker',
            'guest'
            ])
            ->where([['display', 1], ['type', 1]])
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('order')->with(['orders' => $orders]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $equipmentTemplates = EquipmentTemplate::with(['equipments'])->where('display', 1)->get();
        $departments = Department::all();
        $stocker_id = Auth::user()->id;
        $categories = Category::all();
        return view('create-order-multi')->with([
            'users' => $users,
            'departments' => $departments,
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
        $categories = Category::all();
        $equipmentTemplates = EquipmentTemplate::with([
            'equipments.supplier'
        ])->get();
        $order->load(['stocker', 'guest']);
        $order->orderRequestInfos->load([
            'template', 
            'orderInfos', 
            'orderInfos.equipment',
            'template.equipments',
            'template.equipments.orderInfos.orderRequestInfo.order',
            'template.equipments.supplier',
            ]);
        return view('order-detail')->with([
            'order' => $order,
            'equipmentTemplates' => $equipmentTemplates,
            'categories' => $categories
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
        $order->update(['display' => 0]);
        return Order::where('display', 1)->get();
    }

    public function storeRequest(Request $request) {
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

    public function loadOrder(Order $order) {
        $order->load(['stocker', 'guest', 'orderRequestInfos',]);
        $order->orderRequestInfos->load([
            'template', 
            'orderInfos', 
            'orderInfos.equipment',
            'template.equipments',
            'template.equipments.orderInfos.orderRequestInfo.order',
            'template.equipments.supplier',
            ]);
        return $order;
    }

    public function back(Order $order) {
        if($order->status < 1 || $order->status > 3) {
            return 'Order status must be 1, 2 or 3';
        }
        if($order->status > 1) {
            foreach($order->orderRequestInfos as $orderRequestInfo) {
                foreach($orderRequestInfo->orderInfos as $orderInfo) {
                    if($order->status == 2) {
                        $orderInfo->equipment->update(['status' => 1]);
                        $orderInfo->update(['backing' => 1, ]); // backing
                    } 
                }
            }
        }
        $order->update(['status' => $order->status - 1]);
        return $this->loadOrder($order);
    }

    public function acceptOrderRequest(Request $request, Order $order) {
        $dateApproved = date_create($request->input('dateApproved'));
        
        $order->update([
            'status' => 1,
            'date_approved' => date_format($dateApproved, 'Y-m-d H:i:s')
            ]);
        $order->load(['guest']);
        
        return $this->loadOrder($order);
    }
    
    public function rejectOrderRequest(Order $order) {
        $order->update(['status' => -1]); //reject
        $order->load(['guest']);
        return $this->loadOrder($order);
    }

    public function equipmentOutput(Request $request, Order $order) {
        $orderRequestInfos = $request->input('orderRequestInfos');
        $dateOutput = date_create($request->input('dateOutput'));
        $save = $request->input('save');
        try {
            $this->deleteRequestInfoNotSend($request, $order);
            $this->deleteOrderInfoNotSend($request, $order);
            $this->storeAriseRequest($request, $order);
            $this->createOrUpdateRequestInfo($request, $order);
            $order = $this->loadOrder($order);
            $this->checkEquipmentsAvailable($request, $order);
            $this->createOrUpdateOrderInfo($request, $order);
            if(!$save) {
                $this->updateEquipmentStatus($request, $order);
                $order->update([
                    'status' => 2, //output
                    'date_output' => date_format($dateOutput, 'Y-m-d H:i:s')
                ]);
            }
        } catch(Exception $e) {
            return json_encode((object) ['error' => $e->getMessage()]);
        }
        return $this->loadOrder($order);
    }
    public function storeAriseRequest(Request $request, Order $order) {
        $orderRequestInfos = $request->input('orderRequestInfos');
        foreach($orderRequestInfos as $info) {
            // Check if requestInfo exist
            if($order->orderRequestInfos()->where('template_id', $info['template_id'])->count() > 0) {
                continue;
            }
            // Create new request info
            $order->orderRequestInfos()->create([
                'template_id' => $info['template_id'],
                'amount' => $info['amount'],
            ]);
        }
    }
    public function checkEquipmentAvailable(Equipment $equipment) {
        return $equipment->status == 1;
    }
    public function checkEquipmentsAvailable(Request $request, Order $order) {
        $orderRequestInfos = $request->input('orderRequestInfos');
        foreach($order->orderRequestInfos as $orderRequestInfoModel) {
            $template_id = $orderRequestInfoModel->template_id;
            foreach($orderRequestInfos[$template_id]['order_infos'] as $orderInfo){
                $equipment = Equipment::where('id', $orderInfo['equipment_id'])->first();
                if(!$this->checkEquipmentAvailable($equipment)){
                    throw new Exception('[error] Thiết bị '. $equipment->template->name . ' có mã ' . $equipment->id .' đã cho mượn');
                }
            }
        }
    }
    public function createOrUpdateRequestInfo(Request $request, Order $order) {
        $orderRequestInfos = $request->input('orderRequestInfos');
        foreach($orderRequestInfos as $orderRequestInfo) {
            // if request existed then update
            $existedRequestInfos = $this->getExistedRequestInfos($orderRequestInfo, $order);
            if($existedRequestInfos->count() > 0) {
                $existedRequestInfo = $existedRequestInfos->first();
                $existedRequestInfo->update(['amount' => $orderRequestInfo['amount']]);
            }
        }
    }
    public function getExistedRequestInfos($requestInfo, Order $order) {
        return $order->orderRequestInfos()->where('template_id', $requestInfo['template_id']);
    }
    public function createOrUpdateOrderInfo(Request $request, Order $order) {
        $orderRequestInfos = $request->input('orderRequestInfos');
        $save = $request->input('save');
        foreach($order->orderRequestInfos as $orderRequestInfoModel) {
            $template_id = $orderRequestInfoModel->template_id;
            foreach($orderRequestInfos[$template_id]['order_infos'] as $orderInfo){
                // update if existed
                $existedOrderInfos = $this->getExistedOrderInfos($orderInfo, $orderRequestInfoModel);
                if ($existedOrderInfos->count() > 0) {
                    $existedOrderInfo = $existedOrderInfos->first();
                    $existedOrderInfo->update([
                        'backing' => 0,
                    ]);
                    // delete backing orderinfo
                    // $equipment = Equipment::where('id', $orderInfo['equipment_id'])->first();
                    // $equipment->orderInfos()->where('backing', 1)->delete();
                } else {
                    $backing = 0;
                    if($save) $backing = 1;
                    // Create if not existed
                    $orderRequestInfoModel->orderInfos()->create([
                        'equipment_id' => $orderInfo['equipment_id'],
                        'condition_before' => $orderInfo['condition_before'],
                        'backing' => $backing
                    ]);
                }
            }
        }
    }
    public function getExistedOrderInfos($orderInfo, OrderRequestInfo $orderRequest) {
        return $orderRequest->orderInfos()->where('equipment_id', $orderInfo['equipment_id']);
    }
    public function deleteRequestInfoNotSend(Request $request, Order $order) {
        $clientOris = $request->input('orderRequestInfos');
        foreach($order->orderRequestInfos as $orderRequestInfoModel) {
            // find request info in client request
            $found = false;
            foreach($clientOris as $templateId => $clientRequestInfo) {
                if($templateId == $orderRequestInfoModel->template_id) {
                    $found = true;
                }
            }
            // if not found then delete
            if(!$found) {
                $orderRequestInfoModel->delete();
            }
        }
    }
    public function deleteOrderInfoNotSend(Request $request, Order $order) {
        $clientOri = $request->input('orderRequestInfos');
        foreach($order->orderRequestInfos as $orderRequestInfoModel) {
            $templateId = $orderRequestInfoModel->template_id;
            foreach($orderRequestInfoModel->orderInfos as $orderInfo){
                // find order info in client request
                $found = false;
                foreach($clientOri[$templateId]['order_infos'] as $clientOrderInfo) {
                    if($clientOrderInfo['equipment_id'] == $orderInfo->equipment_id) {
                        $found = true;
                    }
                }
                // if not found then delete
                if(!$found) {
                    $orderInfo->delete();
                }
            }
        }
    }
    public function updateEquipmentStatus(Request $request, Order $order) {
        $orderRequestInfos = $request->input('orderRequestInfos');
        foreach($order->orderRequestInfos as $orderRequestInfoModel) {
            $template_id = $orderRequestInfoModel->template_id;
            foreach($orderRequestInfos[$template_id]['order_infos'] as $orderInfo){
                $equipment = Equipment::where('id', $orderInfo['equipment_id'])->first();
                $equipment->update(['status' => 2]);
            }
        }
    }

    public function equipmentReturn(Request $request, Order $order) {
        $orderRequestInfos = $request->input('orderRequestInfos');
        $dateReturn = date_create($request->input('dateReturn'));
        $save = $request->input('save');
        
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
        if(!$save) {
            $order->update([
                'status' => 3, //returnEquipment
                'date_received' => date_format($dateReturn, 'Y-m-d H:i:s')
                ]);
        }
        $order->load(['guest']);

        return $this->loadOrder($order);
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

        return $this->loadOrder($order);
    }
}

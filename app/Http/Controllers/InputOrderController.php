<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\EquipmentTemplate;
use App\Supplier;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Exception;

class InputOrderController extends Controller
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
            'orderRequestInfos.template', 
            'stocker',
            'supplier'
            ])
            ->where([['display', 1], ['type', 2]])
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('input-order')->with(['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipmentTemplates = EquipmentTemplate::with('equipments')->where('display', 1)->get();
        $suppliers = Supplier::all();
        $stocker_id = Auth::user()->id;
        $categories = Category::with('templates')->get();
        return view('create-input-order')->with([
            'stocker_id' => $stocker_id,
            'categories' => $categories,
            'suppliers' => $suppliers,
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
        try {
            $items = $request->input('selectedItems');
            $type = $request->input('type');
            $stockerId = $request->input('stocker_id');
            $dateInput = $request->input('dateInput');
            $order = Order::create([
                'type' => $type,
                'stocker_id' => $stockerId,
                'date_input' => $dateInput,
                'status' => 4
            ]);
            foreach($items as $item) {
                $order->orderRequestInfos()->create([
                    'template_id' => $item['template']['id'],
                    'amount' => $item['amount'],
                    'supplier_id' => $item['supplier_id'],
                    'supplier_name' => $item['supplier_name'],
                    'price' => $item['price'],
                    'warranty' => $item['warranty'],
                ]);
            }
            foreach($items as $item) {
                $template = EquipmentTemplate::where('id', $item['template']['id'])->first();
                for($i = 0; $i < $item['amount']; $i++) {
                    $template->equipments()->create([
                        'price' => $item['price'],
                        'supplier_id' => $item['supplier_id'],
                        'supplier_name' => $item['supplier_name'],
                        'condition' => 2,
                        'input_date' => $dateInput,
                        'warranty' => $item['warranty'],
                    ]);
                }
            }
            return $order;
        } catch(Exception $e) {
            return json_encode((object) ['error' => $e->getMessage()]);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $order = Order::where('id', $id)->first();
            $order->update(['display' => 0]);
            return $order;
        } catch(Exception $e) {
            return json_encode((object) ['error' => $e->getMessage()]);
        }
    }
}

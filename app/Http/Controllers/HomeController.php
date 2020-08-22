<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalEquipmentAmount = Equipment::get()->count();
        $totalOrderAmount = Order::get()->count();
        $equipmentLostAmount = Equipment::where('status', 0)->get()->count();
        $equipmentAvailableAmount = Equipment::where('status', 1)->get()->count();
        $equipmentWorkingAmount = Equipment::where('status', 2)->get()->count();
        $orderPendingAmount = Order::where('status', 0)->get()->count();
        $orderProcessingAmount = Order::whereBetween('status', [1, 3])->get()->count();
        $orderCompletedAmount = Order::where('status', 4)->get()->count();
        $equipments = Equipment::get();
        return view('home')->with([
            'totalEquipmentAmount' => $totalEquipmentAmount,
            'totalOrderAmount' => $totalOrderAmount,
            'equipmentLostAmount' => $equipmentLostAmount,
            'equipmentAvailableAmount' => $equipmentAvailableAmount,
            'equipmentWorkingAmount' => $equipmentWorkingAmount,
            'orderPendingAmount' => $orderPendingAmount,
            'orderProcessingAmount' => $orderProcessingAmount,
            'orderCompletedAmount' => $orderCompletedAmount
        ]);
    }
}

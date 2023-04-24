<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
    return view('admin.home');

    }

    public function create(){
        
    }

    public function showorder(){
        $order = Order::all();
        $order_item = OrderItem::all();
        return view('admin.showorder',["order" =>$order,"order_item" =>$order_item]);
    }

    public function updatestatus($id){
        $order = OrderItem::find($id);
        $order->status ="DELIVERED";
        $order->save();

        return redirect()->back();
    }
}

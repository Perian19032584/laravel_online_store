<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function home(){
        $orders = Order::where('status', 1)->paginate(6);
        return view('auth.orders.home', compact('orders'));
    }
    public function show(Order $order){
        return view('auth.orders.show', compact('order'));
    }
}

<?php

namespace App\Http\Controllers\Person;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function home(){
        $orders = Auth::user()->orders()->where('status', 1)->paginate(6);
        return view('auth.orders.home', compact('orders'));
    }
    public function show(Order $order){
        if(!Auth::user()->orders->contains($order)){
            return back();
        }
        return view('auth.orders.show', compact('order'));
    }
}

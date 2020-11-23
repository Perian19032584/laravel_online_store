<?php

namespace App\Http\Middleware;

use App\Order;
use Closure;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $order_id = session('order_id');
        if(!is_null($order_id)){
            $order = Order::findOrFail($order_id);
            if($order->products->count() > 0){
                return $next($request);
            }
        }
        session()->flash('warning', 'Ваша корзина пуста!');
        return redirect()->route('home2');
    }
}

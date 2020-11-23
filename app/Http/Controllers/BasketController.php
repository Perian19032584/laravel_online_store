<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('order_id');

        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);//Извлекает первый результат запроса
        }

        return view('basket', compact('order'));
    }

    public function order()
    {
        $orderId = session('order_id');

        if(is_null($orderId)){
            return redirect()->route('home2');
        }
        $order = Order::find($orderId);
        return view('order', compact('order'));
    }

    public function confirm(Request $request){
        $orderId = session('order_id');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);

        $success = $order->saveOrder($request->name, $request->phone);

        if ($success){
            session()->flash('success', 'Ваш заказ принят в обработку!');
        }else{
            session()->flash('warning', 'Произошла ошибка');
        }

        return redirect()->route('home2');
    }

    public function basket_add($product_id)
    {//Робота з сесиями
        $orderId = session('order_id');
        if (is_null($orderId)) {
            $order = Order::create();//Идет запись базы данных, создаем поля только автоинримент, updated_at created_at
            session(['order_id' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($product_id)) {
            $pivotRow = $order->products()->where('product_id', $product_id)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($product_id);
        }

        if(Auth::check()){//Чей заказ: пользователя пидора
            $order->user_id = Auth::id();
            $order->save();
        }

        $flash_name_product = Product::find($product_id);
        session()->flash('success', 'Добавлен товар '. $flash_name_product->name."!");

        return redirect()->route('basket');

    }

    public function basket_remove($product_id)
    {
        $orderId = session('order_id');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);

        if ($order->products->contains($product_id)) {
            $pivotRow = $order->products()->where('product_id', $product_id)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($product_id);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        $flash_name_product = Product::find($product_id);

        session()->flash('remove', 'Удален товар '. $flash_name_product->name."!");

        return redirect()->route('basket');
    }
}

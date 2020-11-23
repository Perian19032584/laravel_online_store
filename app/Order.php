<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }
    public function calculate($data){
        $sum = 0;
        foreach ($this->products as $product){
            $sum += $product->price * $data;
        }
        return $sum;
    }
    public function saveOrder($name, $phone){
        if($this->status == 0){
            $this->name = $name;
            $this->phone = $phone;
            $this->status = 1;
            $this->save();

            session()->forget('order_id');

            return true;
        }else{
            return false;
        }
    }


}

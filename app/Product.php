<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Product extends Model{

    protected $fillable = ['category_id', 'name', 'code', 'description', 'price', 'image', 'new', 'hit', 'recommend'];

    public function category(){//Это привязка продукта
        return $this->belongsTo(Category::class, 'category_id');//Значение по ключам
    }
    public function getPriceForCount($count){
        return $this->price * $count;//price из таблицы продукт
    }

    public function setNewAttribute($value){
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
    }
    public function setHitAttribute($value){
       $this->attributes['hit'] = $value === 'on' ? 1 : 0;
    }
    public function setRecommendAttribute($value){
        $this->attributes['recommend'] = $value === 'on' ? 1 : 0;
    }

    public function isHit(){
        return $this->hit === 1;
    }
    public function isNew(){
        return $this->new === 1;
    }
    public function isRecommend(){
        return $this->recommend === 1;
    }
}

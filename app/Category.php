<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['code', 'description', 'name', 'image'];
    public function products(){
        return $this->hasMany(Product::class);//hasMany несколько значений
    }
}

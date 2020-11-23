<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        $rules = [
            'code' => 'required|min:3|max:255|unique:categories,code',
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:5|max:255',
        ];
        if($this->route()->named('categories.update')){
            $rules['code'] .= "," . $this->route()->parameter('category')->id;
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'min' => 'Поле :attribute должно имметь минимум :min символов',
            'max' => 'Поле :attribute должно имметь максимум :max символов'
        ];
    }
}

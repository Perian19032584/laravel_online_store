<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'code' => 'required|min:3|max:255',
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:5|max:255',
            'category_id' => 'required',
            'price' => 'required|min:1|numeric',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'min' => 'Поле :attribute должно имметь минимум :min символов',
            'max' => 'Поле :attribute должно имметь максимум :max символов',
            'category_id' => 'Замечена ошибка',
        ];
    }
}

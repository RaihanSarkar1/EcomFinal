<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'code' => 'required|unique:products,code',
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'category' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|nullable'
        ];
    }
}

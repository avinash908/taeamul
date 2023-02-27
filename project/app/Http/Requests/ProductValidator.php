<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'sku' => 'required',
            'condition' => 'required',
            // 'categories' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'price' => 'required',
            'product_thumbnail' => 'required',
        ];
    }
}

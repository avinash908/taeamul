<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'customer_name' =>  'required|string|max:255',
            'customer_email'=> 'required|email|max:255',
            'customer_phone'=> 'required|max:12',
            'customer_address'=> 'required',
            'customer_city'=> 'required|max:255',
            'customer_state'=> 'required|max:255',
            'customer_zip'=> 'required|max:255',

            'ship_to_different_address' =>'in:1',

            'shipping_name'=>'required_if:ship_to_different_address,1|max:255',
            'shipping_email'=>'required_if:ship_to_different_address,1|max:255',
            'shipping_phone'=>'required_if:ship_to_different_address,1|max:12',
            'shipping_address'=>'required_if:ship_to_different_address,1|max:255',
            'shipping_city'=>'required_if:ship_to_different_address,1|max:255',
            'shipping_state'=>'required_if:ship_to_different_address,1|max:255',
            'shipping_zip'=>'required_if:ship_to_different_address,1|max:255',

            'createaccount' =>'in:1',

            'payment_method' =>'required',
            'terms-and-conditions' =>'required|in:1',
        ];
    }
}

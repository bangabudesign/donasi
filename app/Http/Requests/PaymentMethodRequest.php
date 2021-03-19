<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
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
            'type' => 'required',
            'category' => 'required',
            'name' => 'required',
            'short_name' => 'required',
            'detail_1' => 'required',
            'detail_2' => 'required|unique:payment_methods,detail_2,'.$this->id,
            'detail_3' => 'required',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|integer',
        ];
    }
}

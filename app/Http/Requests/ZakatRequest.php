<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZakatRequest extends FormRequest
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
            'zakat_id' => 'required|integer|exists:zakats,id',
            'user_id' => 'required|integer|exists:users,id',
            'payment_method_id' => 'required|integer|exists:payment_methods,id',
            'amount' => 'required|integer|min:10000',
            'is_anonim' => 'nullable|integer',
            'comment' => 'nullable|max:140',
            'status' => 'required|integer',
            'payment_status' => 'nullable|integer',
            'payment_date' => 'required_if:payment_status,1,2',
            'payment_detail_1' => 'required_if:payment_status,1,2',
            'payment_detail_2' => 'required_if:payment_status,1,2',
            'payment_detail_3' => 'nullable|max:140',
            'verified_at' => 'required_if:payment_status,1',
            'verified_by' => 'nullable|required_if:payment_status,1|exists:users,id',
        ];
    }
}

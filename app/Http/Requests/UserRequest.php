<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191|unique:users,email,'.$this->id,  
            'phone' => 'required|digits_between:10,14|numeric|unique:users,phone,'.$this->id,   
            'password' => 'nullable|required_without:old_password|string|min:8|confirmed',
            'is_admin' => 'nullable|required_without:old_password|integer',
        ];
    }
}

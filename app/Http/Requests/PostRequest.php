<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|max:255|unique:posts,slug,'.$this->id,            
            'body' => 'required',
            'published_at' => 'required',
            'status' => 'required|integer',
            'featured_image' => 'nullable|image|max:2048',
        ];
    }
}

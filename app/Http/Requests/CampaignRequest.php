<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
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
            'slug' => 'required|alpha_dash|max:255|unique:campaigns,slug,'.$this->id,
            'donation_target' => 'required|integer|min:10.000',
            'finished_at' => 'nullable',
            'description' => 'required',
            'short_description' => 'required|max:140',
            'published_at' => 'required',
            'status' => 'required|integer',
            'featured_image' => 'nullable|image|max:2048',
            'category_id' => 'required',
        ];
    }
}

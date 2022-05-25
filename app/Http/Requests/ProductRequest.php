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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pro_name' => 'required|min:2|unique:products',
            'pro_avatar' => 'required',
            'pro_quantity' => 'required|min:0',
            'pro_price' => 'required|min:0',
            'description' => 'required',
            'pro_parent_id' => 'required',
        ];
    }
}

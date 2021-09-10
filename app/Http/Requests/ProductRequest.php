<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
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
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_type_id' => 'required|exists:product_types,id',
            'audience' => 'nullable',
            'audience_size' => 'nullable|numeric',
            'publication' => 'nullable',
            'distribution' => 'nullable',
            'publication_date' => 'nullable|date',
            'publication_url' => 'nullable|url',
            'partner' => 'nullable',
            'info_hosted' => 'nullable',
            'url' => 'nullable|url',
            'access_conditions' => 'nullable',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}

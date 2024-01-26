<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\ApiRequest;

class AddProductRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:32',
            'model' => 'required|string|max:32',
            'rate' => 'integer|required',
            'price' => 'required|between:0,99.99',
            'amount' => 'required|integer',
            'description' => 'required|string',
            'id_type_product' => 'integer',
        ];
    }
}

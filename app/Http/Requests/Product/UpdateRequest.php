<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\ApiRequest;
class UpdateRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|max:32',
            'model' => 'string|max:32',
            'rate' => 'string|integer',
            'price' => 'between:0,99.99',
            'amount' => 'integer',
            'description' => 'string',
            'id_type_product ' => 'integer',
        ];
    }
}

<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;

class RegistrationRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:32',
            'surname' => 'required|string|max:32',
            'patronymic' => 'max:32',
            'login' => 'required|unique:user|string|max:255',
            'password' => 'required|string|max:255',
            'telephone' => 'required|string|unique:user|max:11|min:11',
            'role_id' => 'integer',
        ];
    }
}

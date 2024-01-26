<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;

class AvatarRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'photo_file' => 'required|file|mimes:png,jpg,jepg|max:2000',
        ];
    }
}

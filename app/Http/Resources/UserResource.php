<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'patronymic' => $this->patronymic,
            'telephone' => $this->telephone,
            'login' => $this->login,
            'role' => $this->role->code,
            'group' => $this->role->name,
            'photo' => $this->photo_file,
        ];
    }
}


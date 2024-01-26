<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'model' => $this->model,
            'rate' => $this->rate,
            'price' => $this->price,
            'amount' => $this->amount,
            'photo' => $this->photo_file,
            'description' => $this->description,
            'type' => $this->type->name,
        ];
    }
}

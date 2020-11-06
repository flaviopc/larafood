<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'identify' => $this->uuid,
            'flag' => $this->uuid,
            'title' => $this->flag,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
        ];
    }
}

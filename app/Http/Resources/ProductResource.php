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
            'flag' => $this->flag,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'image' => \url("storage/{$this->image}"),
        ];
    }
}

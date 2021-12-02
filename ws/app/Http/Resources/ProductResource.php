<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'sumary' =>$this->sumary,
            'image' => $this->image,
            'price' => number_format($this->price,2,',','.'),
            'created' =>  date('Y-m-d H:i:s',strtotime($this->created))
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ['book' => [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'date_of_creation' => $this->date_of_creation,
            'ISBN' => $this->ISBN,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'authors' => $this->authors()->get(),
            'genres' => $this->genres()->get()
        ]];
    }
}

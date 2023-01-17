<?php

namespace App\Http\Resources\HotelRoom;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelRoomIndexResource extends JsonResource
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
            'id' => $this->id,
            'room_number' => $this->room_number,
            'room_type' => $this->roomType->room_type,
            'price' => $this->roomType->price,
            'description' => $this->roomType->description
        ];  
    }
}

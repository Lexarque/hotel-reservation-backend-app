<?php

namespace App\Http\Resources\HotelRoom;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelRoomTypeIndexResource extends JsonResource
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
            'room_type' => $this->room_type,
            'price' => $this->price,
            'description' => $this->description
        ];
    }
}

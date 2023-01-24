<?php

namespace App\Http\Resources\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingOrderIndexResource extends JsonResource
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
            'checkin_date' => $this->checkin_date,
            'checkout_date' => $this->checkout_date,
            'room_type' => $this->roomType->room_type,
            'room_count' => $this->room_count,
            'guest_name' => $this->user->name,
            'status' => $this->status,
        ];
    }
}

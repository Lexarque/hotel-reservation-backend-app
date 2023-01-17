<?php

namespace App\Http\Resources\HotelRoom;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HotelRoomIndexCollection extends ResourceCollection
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'items';
}

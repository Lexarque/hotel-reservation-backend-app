<?php

namespace App\Domain\HotelRoom\Applications;

use App\Shareds\Paginator;
use App\Domain\HotelRoom\Models\HotelRoom;
use App\Http\Requests\IndexApplicationRequest;

class HotelRoomIndexApplication
{
    const SORT_BY_COLUMN_NAME = [
        'room_number',
        'room_type',
        'price'
    ];

    public function __construct(private readonly HotelRoom $hotelRoom)
    {
    }

    public function fetch(IndexApplicationRequest $request)
    {
        $order = getValueOrDefault($request->order, ['desc', 'asc'], 'desc');
        $sort = getValueOrDefault($request->sort, self::SORT_BY_COLUMN_NAME, 'id');

        $queryData = $this->hotelRoom
            ->select([
                'hotel_rooms.*',
                'hotel_room_types.*'
            ])
            ->leftJoin('hotel_room_types', 'hotel_rooms.id', '=', 'hotel_room_types.id')
            ->when($request->search, function ($query, $search) {
                return $query
                    ->where('hotel_rooms.room_number', 'like', "%{$search}%")
                    ->orWhere('hotel_room_types.room_type', 'like', "%{$search}%");
            })
            ->orderBy($sort, $order);

        return Paginator::paginate($queryData, $request->page, $request->per_page);
    }
}
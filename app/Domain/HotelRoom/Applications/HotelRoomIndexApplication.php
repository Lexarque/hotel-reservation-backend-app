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

    /**
     * This function is used to fetch the required data
     * 
     * @param IndexApplicationRequest $request
     * @return Paginator
     */
    public function fetch(IndexApplicationRequest $request): Paginator
    {
        $order = getValueOrDefault($request->order, ['desc', 'asc'], 'desc');
        $sort = getValueOrDefault($request->sort, self::SORT_BY_COLUMN_NAME, 'hotel_rooms.id');

        $queryData = $this->hotelRoom
            ->select([
                'hotel_rooms.*',
                'hotel_room_types.*'
            ])
            ->leftJoin('hotel_room_types', 'hotel_rooms.room_type_id', '=', 'hotel_room_types.id')
            ->when($request->trashed == true, function ($query) {
                return $query->onlyTrashed();
            })
            ->when($request->search, function ($query, $search) {
                return $query
                    ->where('hotel_rooms.room_number', 'like', "%{$search}%")
                    ->orWhere('hotel_room_types.room_type', 'like', "%{$search}%");
            })
            ->orderBy($sort, $order);
      
        return Paginator::paginate($queryData, $request->page, $request->per_page);
    }
}

<?php

namespace App\Domain\HotelRoom\Applications;

use App\Shareds\Paginator;
use App\Domain\HotelRoom\Models\HotelRoomType;
use App\Http\Requests\IndexApplicationRequest;

class HotelRoomTypeIndexApplication
{

    const SORT_BY_COLUMN_NAME = [
        'room_type'
    ];

    public function __construct(private readonly HotelRoomType $hotelRoomType)
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
        $sort = getValueOrDefault($request->sort, self::SORT_BY_COLUMN_NAME, 'id');

        $queryData = $this->hotelRoomType
            ->select([
                'hotel_room_types.*'
            ])
            ->when($request->trashed == true, function ($query) {
                return $query->onlyTrashed();
            })
            ->when($request->search, function ($query, $search) {
                return $query
                    ->where('hotel_room_types.room_type', 'like', "%{$search}%");
            })
            ->orderBy($sort, $order);
        
        return Paginator::paginate($queryData, $request->page, $request->per_page);
    }
}

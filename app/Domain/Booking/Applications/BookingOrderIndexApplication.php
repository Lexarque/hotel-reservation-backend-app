<?php

namespace App\Domain\Booking\Applications;

use App\Shareds\Paginator;
use App\Domain\Booking\Models\BookingOrder;
use App\Http\Requests\IndexApplicationRequest;

class BookingOrderIndexApplication
{
    const SORT_BY_COLUMN_NAME = [
        'status'
    ];

    public function __construct(private readonly BookingOrder $bookingOrder)
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
        $sort = getValueOrDefault($request->sort, self::SORT_BY_COLUMN_NAME, 'booking_orders.id');

        $queryData = $this->bookingOrder
            ->select([
                'booking_orders.*',
                'hotel_room_types.*',
                'users.*'
            ])
            ->leftJoin('hotel_room_types', 'booking_orders.room_type_id', '=', 'hotel_room_types.id')
            ->leftJoin('users', 'booking_orders.user_id', '=', 'users.id')
            ->when($request->trashed == true, function ($query) {
                return $query->onlyTrashed();
            })
            ->when($request->search, function ($query, $search) {
                return $query
                    ->where('users.name', 'like', "%{$search}%")
                    ->orWhere('hotel_room_types.room_type', 'like', "%{$search}%");
            })
            ->when($request->status, function ($query, $status) {
                return $query->where('booking_orders.status', $status);
            })
            ->when($request->start_date && $request->end_date, function ($query, $start_date, $end_date) {
                return $query->whereBetween('booking_orders.checkin_date', [$start_date, $end_date])
                    ->whereBetween('booking_orders.checkout_date', [$start_date, $end_date]);
            })
            ->orderBy($sort, $order);
      
        return Paginator::paginate($queryData, $request->page, $request->per_page);
    }
}

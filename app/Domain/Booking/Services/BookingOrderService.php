<?php

namespace App\Domain\Booking\Services;

use App\Shareds\BaseService;
use App\Domain\Booking\Models\BookingOrder;
use Illuminate\Support\Facades\Auth;

class BookingOrderService extends BaseService
{
    /**
     * Assign the desired relation
     * 
     * @var array
     */
    protected $with = ['roomType', 'user'];

    public function __construct(private readonly BookingOrder $bookingOrder)
    {
        parent::__construct($bookingOrder);
    }

    /**
     * Create a new booking order data
     * 
     * @param array $attributes
     * @return void
     */
    public function createData(array $attributes): void 
    {
        $bookingOrderData = [
            'checkin_date' => $attributes['checkin_date'],
            'checkout_date' => $attributes['checkout_date'],
            'room_type_id' => $attributes['rooms'][0]->room_type_id,
            'room_count' => count($attributes['rooms']),
            'user_id' => Auth::user()->id,
        ];

        $this->bookingOrder->fill($bookingOrderData)->saveOrFail();
    }

     /**
     * update an existing booking order data
     * 
     * @param array $attributes
     * @return void
     */
    public function updateData(BookingOrder $bookingOrder, array $attributes): void 
    {
        $bookingOrderData = [
            'checkin_date' => $attributes['checkin_date'],
            'checkout_date' => $attributes['checkout_date'],
            'room_type_id' => $attributes['rooms'][0]->room_type_id,
            'room_count' => count($attributes['rooms']),
            'user_id' => $attributes['user_id'],
        ];

        $bookingOrder->fill($bookingOrderData)->updateOrFail();
    }

    /**
     * Delete booking order data by id
     *
     * @param int $id
     * @return void
     * @throws \Throwable
     */
    public function delete(int $id): void
    {
        $bookingOrder = $this->bookingOrder->findOrFail($id);
        $bookingOrder->deleteOrFail();
    }
}

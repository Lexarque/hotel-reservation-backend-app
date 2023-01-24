<?php

namespace App\Domain\Booking\Applications;

use App\Domain\Booking\Services\BookingOrderService;
use App\Http\Requests\Booking\BookingOrderCreateRequest;
use App\Http\Requests\Booking\BookingOrderUpdateRequest;

class BookingOrderCrudApplication
{
    public function __construct(private readonly BookingOrderService $bookingOrderService)
    {
    }

    /**
     * Get single data by id
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find(int $id): \Illuminate\Database\Eloquent\Model
    {
        return $this->bookingOrderService->findById($id);
    }

    /**
     * create a new booking order data
     *
     * @param BookingOrderCreateRequest $request
     * @return void
     */
    public function create(BookingOrderCreateRequest $request): void
    {
        $this->bookingOrderService->createData($request->validated());
    }

    /**
     * update an existing booking order data
     *
     * @param BookingOrderUpdateRequest $request
     * @param int $id
     * @return void
     */
    public function update(BookingOrderUpdateRequest $request, int $id): void
    {
        $this->bookingOrderService->updateData($this->find($id), $request->validated());
    }

    /**
     * delete an existing booking order data
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->bookingOrderService->delete($id);
    }

    /**
     * restore a soft deleted booking order data
     *
     * @param int $id
     * @return void
     */
    public function restore(int $id): void
    {
        $this->bookingOrderService->restore($id);
    }
}

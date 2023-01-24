<?php

namespace App\Http\Controllers\Booking;

use Inertia\Inertia;
use Inertia\Response;
use App\Shareds\ControllerRedirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\IndexApplicationRequest;
use App\Http\Requests\Booking\BookingOrderCreateRequest;
use App\Http\Resources\Booking\BookingOrderIndexCollection;
use App\Domain\Booking\Applications\BookingOrderCrudApplication;
use App\Domain\Booking\Applications\BookingOrderIndexApplication;
use App\Http\Requests\Booking\BookingOrderUpdateRequest;

class BookingOrderController extends Controller
{
    public function __construct(
        private readonly BookingOrderIndexApplication $bookingOrderIndexApplication,
        private readonly BookingOrderCrudApplication $bookingOrderCrudApplication
    ) {
    }

    /**
     * Show booking order data list
     * 
     * @param IndexApplicationRequest $request
     * @return Response
     */
    public function index(IndexApplicationRequest $request): Response
    {
        $dataList = $this->bookingOrderIndexApplication->fetch($request);

        $props = [
            'data' => (new BookingOrderIndexCollection($dataList->items))->additional(['meta' => $dataList->meta])
        ];

        return Inertia::render('Booking/Index', $props);
    }

    /**
     * Render the create page
     * 
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Booking/Create');
    }

    /**
     * Render the edit page
     * 
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $props = [
            'data' => $this->bookingOrderCrudApplication->find($id),
        ];

        return Inertia::render('Booking/Update', $props);
    }

    /**
     * Show booking order data list
     * 
     * @param BookingOrderCreateRequest $request
     * @return RedirectResponse
     */
    public function save(BookingOrderCreateRequest $request): RedirectResponse
    {
        $this->bookingOrderCrudApplication->create($request);

        return ControllerRedirect::responseSuccess('/hotel-room', 'Successfully created a new booking order data');
    }

    /**
     * Show booking order data list
     * 
     * @param BookingOrderUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BookingOrderUpdateRequest $request, int $id): RedirectResponse
    {
        $this->bookingOrderCrudApplication->update($request, $id);

        return ControllerRedirect::responseSuccess("/hotel-room/{$id}", 'Successfully created a new booking order data');
    }

    /**
     * Soft delete a record
     * 
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->bookingOrderCrudApplication->delete($id);

        return ControllerRedirect::responseSuccess('/hotel-room', "Successfully deleted booking order data");
    }

    /**
     * Restore a soft deleted record
     * 
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        $this->bookingOrderCrudApplication->restore($id);

        return ControllerRedirect::responseSuccess('/hotel-room', "Successfully restored booking order data");
    }
}

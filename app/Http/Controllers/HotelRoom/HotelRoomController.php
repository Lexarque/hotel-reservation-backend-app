<?php

namespace App\Http\Controllers\HotelRoom;

use Inertia\Inertia;
use Inertia\Response;
use App\Shareds\ControllerRedirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\IndexApplicationRequest;
use App\Http\Requests\HotelRoom\HotelRoomCreateRequest;
use App\Http\Requests\HotelRoom\HotelRoomUpdateRequest;
use App\Http\Resources\HotelRoom\HotelRoomIndexCollection;
use App\Domain\HotelRoom\Applications\HotelRoomCrudApplication;
use App\Domain\HotelRoom\Applications\HotelRoomIndexApplication;

class HotelRoomController extends Controller
{
    public function __construct(
        private readonly HotelRoomIndexApplication $hotelRoomIndexApplication,
        private readonly HotelRoomCrudApplication $hotelRoomCrudApplication
    ) {
    }

    /**
     * Show hotel room data list
     * 
     * @param IndexApplicationRequest $request
     * @return Response
     */
    public function index(IndexApplicationRequest $request): Response
    {
        $dataList = $this->hotelRoomIndexApplication->fetch($request);

        $props = [
            'data' => (new HotelRoomIndexCollection($dataList->items))->additional(['meta' => $dataList->meta])
        ];
    
        return Inertia::render('HotelRoom/Index', $props);
    }

    /**
     * Render the create page
     * 
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('HotelRoom/Create');
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
            'data' => $this->hotelRoomCrudApplication->find($id),
        ];

        return Inertia::render('HotelRoom/Update', $props);
    }

    /**
     * Show hotel room data list
     * 
     * @param HotelRoomCreateRequest $request
     * @return RedirectResponse
     */
    public function save(HotelRoomCreateRequest $request): RedirectResponse
    {
        $this->hotelRoomCrudApplication->create($request);

        return ControllerRedirect::responseSuccess('/hotel-room', 'Successfully created a new hotel room data');
    }

    /**
     * Show hotel room data list
     * 
     * @param HotelRoomUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(HotelRoomUpdateRequest $request, int $id): RedirectResponse
    {
        $this->hotelRoomCrudApplication->update($request, $id);

        return ControllerRedirect::responseSuccess("/hotel-room/{$id}", 'Successfully created a new hotel room data');
    }

    /**
     * Soft delete a record
     * 
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $roomNumber = $this->hotelRoomCrudApplication->find($id);
        $this->hotelRoomCrudApplication->delete($id);

        return ControllerRedirect::responseSuccess('/hotel-room', "Successfully deleted hotel room number $roomNumber->room_number");
    }

    /**
     * Restore a soft deleted record
     * 
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        $roomNumber = $this->hotelRoomCrudApplication->find($id);
        $this->hotelRoomCrudApplication->restore($id);

        return ControllerRedirect::responseSuccess('/hotel-room', "Successfully restored hotel room number $roomNumber->room_number data");
    }
}

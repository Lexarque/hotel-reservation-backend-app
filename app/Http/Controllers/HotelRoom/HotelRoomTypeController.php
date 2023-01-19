<?php

namespace App\Http\Controllers\HotelRoom;

use Inertia\Inertia;
use Inertia\Response;
use App\Shareds\ControllerRedirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\IndexApplicationRequest;
use App\Http\Requests\HotelRoom\HotelRoomTypeCreateRequest;
use App\Http\Requests\HotelRoom\HotelRoomTypeUpdateRequest;
use App\Http\Resources\HotelRoom\HotelRoomTypeIndexCollection;
use App\Domain\HotelRoom\Applications\HotelRoomTypeCrudApplication;
use App\Domain\HotelRoom\Applications\HotelRoomTypeIndexApplication;

class HotelRoomTypeController extends Controller
{
    public function __construct(
        private readonly HotelRoomTypeIndexApplication $hotelRoomTypeIndexApplication,
        private readonly HotelRoomTypeCrudApplication $hotelRoomTypeCrudApplication
    ) {
    }

    /**
     * Show hotel room type data list
     * 
     * @param IndexApplicationRequest $request
     * @return Response
     */
    public function index(IndexApplicationRequest $request)
    {
        $dataList = $this->hotelRoomTypeIndexApplication->fetch($request);

        $props = [
            'data' => (new HotelRoomTypeIndexCollection($dataList->items))->additional(['meta' => $dataList->meta])
        ];
        
        return Inertia::render('HotelRoomType/Index', $props);
    }

    /**
     * Render the create page
     * 
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('HotelRoomType/Create');
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
            'data' => $this->hotelRoomTypeCrudApplication->find($id),
        ];
        
        return Inertia::render('HotelRoomType/Update', $props);
    }

    /**
     * Show hotel room type data list
     * 
     * @param HotelRoomTypeCreateRequest $request
     * @return RedirectResponse
     */
    public function save(HotelRoomTypeCreateRequest $request): RedirectResponse
    {
        $this->hotelRoomTypeCrudApplication->create($request);

        return ControllerRedirect::responseSuccess('/hotel-room-type', 'Successfully created a new hotel room type data');
    }

    /**
     * Show hotel room type data list
     * 
     * @param HotelRoomTypeUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(HotelRoomTypeUpdateRequest $request, int $id): RedirectResponse
    {
        $this->hotelRoomTypeCrudApplication->update($request, $id);

        return ControllerRedirect::responseSuccess("/hotel-room-type/{$id}", 'Successfully created a new hotel room type data');
    }

    /**
     * Soft delete a record
     * 
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $roomNumber = $this->hotelRoomTypeCrudApplication->find($id);
        $this->hotelRoomTypeCrudApplication->delete($id);

        return ControllerRedirect::responseSuccess('/hotel-room-type', "Successfully deleted hotel room type number $roomNumber->room_number");
    }

    /**
     * Restore a soft deleted record
     * 
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        $roomNumber = $this->hotelRoomTypeCrudApplication->find($id);
        $this->hotelRoomTypeCrudApplication->restore($id);

        return ControllerRedirect::responseSuccess('/hotel-room-type', "Successfully restored hotel room type number $roomNumber->room_number data");
    }
}

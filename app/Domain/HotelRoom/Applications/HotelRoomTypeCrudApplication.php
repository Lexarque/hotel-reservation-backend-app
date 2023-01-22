<?php

namespace App\Domain\HotelRoom\Applications;

use App\Domain\HotelRoom\Services\HotelRoomTypeService;
use App\Http\Requests\HotelRoom\HotelRoomTypeCreateRequest;
use App\Http\Requests\HotelRoom\HotelRoomTypeUpdateRequest;

class HotelRoomTypeCrudApplication
{
    public function __construct(
        private readonly HotelRoomTypeService $hotelRoomTypeService
    ) {
    }

    /**
     * Get single data by id
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find(int $id): \Illuminate\Database\Eloquent\Model
    {
        return $this->hotelRoomTypeService->findById($id);
    }

    /** 
     * create a new hotel room data
     *
     * @param HotelRoomCreateRequest $request
     * @return void
     */
    public function create(HotelRoomTypeCreateRequest $request): void
    {
        $this->hotelRoomTypeService->createData($request->validated(), $request->only('photo_images'));
    }

    /**
     * update an existing hotel room data
     *
     * @param HotelRoomUpdateRequest $request
     * @param int $id
     * @return void
     */
    public function update(HotelRoomTypeUpdateRequest $request, int $id): void
    {
        $this->hotelRoomTypeService->updateData($this->find($id), $request->validated(), $request->only('photo_images'));
    }

    /**
     * delete an existing hotel room data
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->hotelRoomTypeService->delete($id);
    }

    /**
     * restore a soft deleted hotel room data
     *
     * @param int $id
     * @return void
     */
    public function restore(int $id): void
    {
        $this->hotelRoomTypeService->restore($id);
    }
}

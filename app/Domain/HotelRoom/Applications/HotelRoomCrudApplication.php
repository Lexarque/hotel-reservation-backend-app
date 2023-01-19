<?php

namespace App\Domain\HotelRoom\Applications;

use App\Domain\HotelRoom\Services\HotelRoomService;
use App\Http\Requests\HotelRoom\HotelRoomCreateRequest;
use App\Http\Requests\HotelRoom\HotelRoomUpdateRequest;

class HotelRoomCrudApplication
{
    public function __construct(
        private readonly HotelRoomService $hotelRoomService
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
        return $this->hotelRoomService->findById($id);
    }

    /**
     * create a new hotel room data
     *
     * @param HotelRoomCreateRequest $request
     * @return void
     */
    public function create(HotelRoomCreateRequest $request): void
    {
        $this->hotelRoomService->createData($request->validated());
    }

    /**
     * update an existing hotel room data
     *
     * @param HotelRoomUpdateRequest $request
     * @param int $id
     * @return void
     */
    public function update(HotelRoomUpdateRequest $request, int $id): void
    {
        $this->hotelRoomService->updateData($this->find($id), $request->validated());
    }

    /**
     * delete an existing hotel room data
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->hotelRoomService->delete($id);
    }

    /**
     * restore a soft deleted hotel room data
     *
     * @param int $id
     * @return void
     */
    public function restore(int $id): void
    {
        $this->hotelRoomService->restore($id);
    }
}

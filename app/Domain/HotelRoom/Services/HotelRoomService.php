<?php

namespace App\Domain\HotelRoom\Services;

use App\Shareds\BaseService;
use App\Domain\HotelRoom\Models\HotelRoom;

class HotelRoomService extends BaseService
{

    /**
     * Assign the desired relation
     * 
     * @var array
     */
    protected $with = ['roomType'];

    public function __construct(public readonly HotelRoom $hotelRoom)
    {
        parent::__construct($hotelRoom);
    }

    /**
     * Create a new hotel room data
     * 
     * @param array $attributes
     * @return void
     */
    public function createData(array $attributes): void 
    {
        $this->hotelRoom->fill($attributes)->saveOrFail();
    }

     /**
     * update an existing hotel room data
     * 
     * @param array $attributes
     * @return void
     */
    public function updateData(HotelRoom $hotelRoom, array $attributes): void 
    {
        $hotelRoom->fill($attributes)->updateOrFail();
    }

    /**
     * Delete hotel room data by id
     *
     * @param int $id
     * @return void
     * @throws \Throwable
     */
    public function delete(int $id): void
    {
        $hotelRoom = $this->hotelRoom->findOrFail($id);
        $hotelRoom->deleteOrFail();
    }
}

<?php

namespace App\Domain\HotelRoom\Services;

use App\Domain\HotelRoom\Models\HotelRoomType;
use App\Shareds\BaseService;

class HotelRoomTypeService extends BaseService
{

    /**
     * Assign the desired relation
     * 
     * @var array
     */
    protected $with = [];

    public function __construct(public readonly HotelRoomType $hotelRoomType)
    {
        parent::__construct($hotelRoomType);
    }

    /**
     * Create a new hotel room data
     * 
     * @param array $attributes
     * @return void
     */
    public function createData(array $attributes): void 
    {
        $this->hotelRoomType->fill($attributes)->saveOrFail();
    }

     /**
     * update an existing hotel room data
     * 
     * @param array $attributes
     * @return void
     */
    public function updateData(HotelRoomType $hotelRoomType, array $attributes): void 
    {
        $hotelRoomType->fill($attributes)->updateOrFail();
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
        $hotelRoomType = $this->hotelRoomType->findOrFail($id);
        $hotelRoomType->deleteOrFail();
    }
}

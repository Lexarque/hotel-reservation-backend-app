<?php

namespace App\Domain\HotelRoom\Services;

use App\Domain\Common\Applications\PhotoApplication;
use App\Domain\HotelRoom\Models\HotelRoomType;
use App\Shareds\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelRoomTypeService extends BaseService
{
    const ROOM_IMAGE = 'room_image';

    /**
     * Assign the desired relation
     * 
     * @var array
     */
    protected $with = [];

    public function __construct(
        public readonly HotelRoomType $hotelRoomType,
        private readonly PhotoApplication $photoApplication
    ) {
        parent::__construct($hotelRoomType);
    }

    /**
     * Create a new hotel room data
     * 
     * @param array $attributes
     * @return void
     */
    public function createData(array $attributes, Request $attrPhotos): void
    {
        DB::transaction(function () use ($attributes, $attrPhotos) {
            $this->hotelRoomType->fill($attributes)->saveOrFail();
            if ($attrPhotos != null) {
                $this->photoApplication->upload($attrPhotos, self::ROOM_IMAGE);
                $this->hotelRoomType->photos()->create($attrPhotos);
            }
        });
    }

    /**
     * update an existing hotel room data
     * 
     * @param array $attributes
     * @return void
     */
    public function updateData(HotelRoomType $hotelRoomType, array $attributes, Request $attrPhotos): void
    {
        DB::transaction(function () use ($attributes, $attrPhotos, $hotelRoomType) {
            $hotelRoomType->fill($attributes)->updateOrFail();
            if ($attrPhotos != null) {
                $this->photoApplication->upload($attrPhotos, self::ROOM_IMAGE);
                $this->hotelRoomType->photos()->create($attrPhotos);
            }
        });
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

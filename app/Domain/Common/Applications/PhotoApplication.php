<?php

namespace App\Domain\Common\Applications;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoApplication
{
    const USER_PROFILE = 'user_profile';
    const ROOM_IMAGE = 'room_image';

    /**
     * this function is used to store the uploaded image file
     *
     * @param Request $request
     * @return array
     */
    public function upload(Request $files, string $entity): array
    {
        $filenames = [];

        foreach ($files as $data) {
            $filename = $entity . '-' . time() . '-' . $data->getClientOriginalExtension();
            $filenames[] = $filename;
            if ($entity == self::USER_PROFILE) {
                Storage::putFileAs('/profile', $data, $filename);
            } else if ($entity == self::ROOM_IMAGE) {
                Storage::putFileAs('/room', $data, $filename);
            }
        }

        return $filenames;
    }
}

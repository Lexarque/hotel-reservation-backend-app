<?php

namespace App\Domain\Common\Services;

use App\Domain\Common\Models\Photo;
use App\Shareds\BaseService;

class PhotoService extends BaseService
{
    public function __construct(Photo $photo)
    {
        parent::__construct($photo);
    }
}

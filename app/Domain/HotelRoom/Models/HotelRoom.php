<?php

namespace App\Domain\HotelRoom\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HotelRoom extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'room_number',
        'room_type_id'
    ];

    /**
     * Define an inverse one-to-many relationship
     * 
     * @return BelongsTo
     */
    public function roomType() {
        return $this->belongsTo(HotelRoomType::class);
    }
}

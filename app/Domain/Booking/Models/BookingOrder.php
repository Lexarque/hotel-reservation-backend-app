<?php

namespace App\Domain\Booking\Models;

use App\Domain\HotelRoom\Models\HotelRoomType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingOrder extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'checkin_date',
        'checkout_date',
        'room_count',
        'room_type_id',
        'user_id',
        'status',
    ];

    /**
     * Define a one-to-one relationship
     *
     * @return HasMany
     */
    public function roomType() {
        return $this->belongsTo(HotelRoomType::class);
    }

    /**
     * Define an inverse one-to-many relationship
     *
     * @return BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}

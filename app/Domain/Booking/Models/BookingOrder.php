<?php

namespace App\Domain\Order\Models;

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
        'guest_name',
        'room_id',
        'user_id',
        'status',
    ];

    /**
     * Define an inverse one-to-many relationship
     *
     * @return BelongsTo
     */
    public function room() {
        return $this->belongsTo(HotelRoom::class);
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

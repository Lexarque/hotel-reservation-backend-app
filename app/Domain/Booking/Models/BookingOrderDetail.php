<?php

namespace App\Domain\Booking\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingOrderDetail extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'staying_period',
        'price',
        'booking_order_id',
    ];

    /**
     * Define a one-to-one relationship
     * 
     * @return HasOne
     */
    public function bookingOrder() {
        return $this->hasOne(BookingOrder::class);
    }
}

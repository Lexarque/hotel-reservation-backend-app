<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_orders', function (Blueprint $table) {
            $table->id();
            $table->date('checkin_date');
            $table->date('checkout_date');
            $table->string('guest_name');
            $table->foreignId('room_id')->constrained('hotel_rooms');
            $table->foreignId('user_id')->constrained('users'); 
            $table->string('status', 20)->default('Booked')->comment('Booked | Staying | Checkout');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_orders');
    }
};

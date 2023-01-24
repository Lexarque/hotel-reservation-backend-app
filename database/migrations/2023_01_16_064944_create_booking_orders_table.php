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
            $table->integer('room_count');
            $table->foreignId('room_type_id')->constrained('hotel_room_types');
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

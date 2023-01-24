<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class BookingOrderUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'checkin_date' => 'nullable|date',
            'checkout_date' => 'nullable|date',
            'room_type_id' => 'required|integer',
            'rooms.*' => 'required|string',
            'user_id' => 'required|integer'
        ];
    }
}

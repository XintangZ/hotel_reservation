<?php

namespace App\Http\Requests;

use App\Models\Reservation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReservationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => [Rule::exists('users', 'id')],
            'room_id' => ['required', Rule::exists('rooms', 'id')],
            'check_in_date' => ['required', 'date', 'after_or_equal:today'],
            'check_out_date' => ['required', 'date', 'after:check_in_date'],
            'number_of_guests' => ['required', 'integer', 'between:1,4'],
        ];
    }

    public function messages(): array
    {
        return [
            'room_id.required' => 'Please select a room.',
            'check_in_date.required' => 'Please select a check-in date.',
            'check_out_date.required' => 'Please select a check-out date.',
            'check_out_date.after' => 'The check-out date must be after the check-in date.',
            'number_of_guests.required' => 'Please enter the number of guests.',
        ];
    }
}

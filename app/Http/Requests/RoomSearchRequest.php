<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomSearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'check_in_date' => ['required', 'date', 'after_or_equal:today'],
            'check_out_date' => ['required', 'date', 'after:check_in_date'],
            'number_of_guests' => ['required', 'integer', 'between:1,4'],
            'reservation_id' => [Rule::exists('reservations', 'id')],
        ];
    }

    public function messages(): array
    {
        return [
            'check_in_date.required' => 'Please select a check-in date.',
            'check_out_date.required' => 'Please select a check-out date.',
            'check_out_date.after' => 'The check-out date must be after the check-in date.',
            'number_of_guests.required' => 'Please enter the number of guests.',
        ];
    }
}

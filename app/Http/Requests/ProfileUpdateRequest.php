<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'phone' => ['string', 'size:14', 'regex:/^([0-9\s\-\+\(\)]*)$/', Rule::unique(User::class)->ignore($this->user()->id)],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.size' => 'The phone number is invalid.',
            'phone.regex' => 'The phone number is invalid.',
            'phone.unique' => 'The phone number has already been used by another user.',
            'email.unique' => 'The email address has already been used by another user.',
        ];
    }
}

<?php

namespace App\Http\Requests\checkout;

use Illuminate\Foundation\Http\FormRequest;

class storeCheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'addr.billing.first_name' => ['required', 'string', 'max:255'],
            'addr.billing.last_name' => ['required', 'string', 'max:255'],
            'addr.billing.email' => ['required', 'string', 'max:255'],
            'addr.billing.phone_number' => ['required', 'string', 'max:255'],
            'addr.billing.city' => ['required', 'string', 'max:255'],
            'addr.billing.street_address' => ['required', 'string', 'max:255'],
            'addr.billing.postal_code' => ['required', 'string', 'max:15'],
            'addr.billing.state' => ['required', 'string', 'max:20'],
            'addr.billing.country' => ['required', 'string', 'max:20'],

            'addr.shipping.first_name' => ['required', 'string', 'max:255'],
            'addr.shipping.last_name' => ['required', 'string', 'max:255'],
            'addr.shipping.email' => ['required', 'string', 'max:255'],
            'addr.shipping.phone_number' => ['required', 'string', 'max:255'],
            'addr.shipping.city' => ['required', 'string', 'max:255'],
            'addr.shipping.street_address' => ['required', 'string', 'max:255'],
            'addr.shipping.postal_code' => ['required', 'string', 'max:15'],
            'addr.shipping.state' => ['required', 'string', 'max:20'],
            'addr.shipping.country' => ['required', 'string', 'max:20'],
        ];
    }
}

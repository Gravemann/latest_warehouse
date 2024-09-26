<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|lte:product_quantity|min:1',
            'product_quantity' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'quantity.lte' => 'The quantity must be less than or equal to ' . $this->product_quantity
        ];
    }
}

<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
            'name' => 'required|string|min:2|',
            'surname' => 'required|string|min:2',
            'contact_number' => 'required|numeric|digits_between:3,12|unique:clients',
            'company' => 'required|string',
            'image' => 'required|image|mimes:jpg,bmp,png,jpeg|max:2048',
        ];
    }
}

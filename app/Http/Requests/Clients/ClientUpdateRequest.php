<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientUpdateRequest extends FormRequest
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
            'surname' => 'required|string|min:2|',
            'contact_number' => ['required','numeric','digits_between:3,12', Rule::unique('clients')->ignore($this->route('client'))],
            'company' => 'required|string|',
            'image' => ['required', Rule::when($this->hasFile('image'), 'image|mimes:jpg,bmp,png,jpeg|max:2048')],
        ];
    }
}

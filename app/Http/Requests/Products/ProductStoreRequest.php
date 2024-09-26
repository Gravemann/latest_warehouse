<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'brand_id' => 'required|integer|',
            'name' => 'required|string|min:2|',
            'purchase_price' => 'required|integer|min:1',
            'sale_price' => 'required|integer|gt:purchase_price',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpg,bmp,png,jpeg|max:2048' 
        ];
    }

    public function messages(): array
    {
        return [
            'brand_id.required' => 'The brand is required',
            'sale_price.gt' => 'The sale price must be greater than purchase price',
        ];
    }
        
}
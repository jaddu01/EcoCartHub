<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required|min:3|max:50',
            'brand' => 'required|min:3|max:30',
            'description' => 'nullable|min:20|max:200',
            'quantity' => 'required|integer',
            'product_price' => 'required|numeric',
            'color' => 'nullable',
        ];
    }
}

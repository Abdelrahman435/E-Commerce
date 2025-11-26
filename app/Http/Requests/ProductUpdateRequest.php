<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
            'price'       => 'sometimes|numeric|min:0',
            'stock'       => 'sometimes|integer|min:0',
            'category_id' => 'sometimes|nullable|exists:categories,id',

            'images'      => 'sometimes|array',
            'images.*'    => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
{
    throw new \Illuminate\Http\Exceptions\HttpResponseException(
        response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422)
    );
}

}

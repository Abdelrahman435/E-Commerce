<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // اسمح للجميع بالتخزين، والـ middleware مسؤول عن الحماية
    }

    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'user_id' => 'nullable|exists:users,id',

            // لو بترفع صور للمنتج
            'images'      => 'nullable|array',
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

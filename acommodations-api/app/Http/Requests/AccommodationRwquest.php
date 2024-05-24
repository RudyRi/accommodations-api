<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AccommodationRwquest extends FormRequest
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
            'name' => 'required|string',
            'address' => 'required|string',
            'capacity' => 'required|numeric',
            'rooms' => 'required|numeric',
            'img_url' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'address.required' => 'Address is required',
            'capacity.required' => 'Capacity is required',
            'rooms.required' => 'Rooms is required',
            'img_url.required' => 'Image URL is required',
            'price.required' => 'Price is required',
            'description.required' => 'Description is required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => false,
            'message' => 'Validation error.',
            'data' => $validator->errors()
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }

    
}

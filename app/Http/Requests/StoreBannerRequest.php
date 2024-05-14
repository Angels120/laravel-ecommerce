<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:banners',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072|dimensions:min_width=1600,min_height=740',
        ];
    }

    public function messages(): array
    {
        return [
            'image.dimensions' => 'The :attribute must be at least 1600 pixels wide and 740 pixels high.',
            'image.mimes' => 'The :attribute must be a valid image file of type: jpeg, png, jpg, or gif.',
        ];
    }
}


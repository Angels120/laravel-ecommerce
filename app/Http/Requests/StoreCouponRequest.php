<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;

class StoreCouponRequest extends FormRequest
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
            'code'=>'required',
            'name'=>'required',
            'descripition'=>'nullable',
            'max_uses'=>'nullable',
            'max_uses_user'=>'nullable',
            'type'=>'required',
            'discount_amount'=>'required|numeric',
            'min_amount'=>'nullable',
            'status'=>'boolean|nullable',
            'starts_at' => ['nullable', 'date', 'after_or_equal:' . Date::now()->toDateString()],
            'expires_at' => 'nullable|date|after:starts_at',
        ];
    }
    public function messages()
    {
        return [
            'starts_at.after_or_equal' => 'The start date must be after or equal to the current date.',
            'expires_at.after' => 'The expiration date must be after the start date.',
        ];
    }
}

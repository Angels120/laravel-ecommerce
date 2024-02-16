<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
            'max_users'=>'nullable',
            'max_uses_user'=>'nullable',
            'type'=>'required',
            'discount_amount'=>'required|numeric',
            'min_amount'=>'nullable',
            'status'=>'boolean|nullable',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after:starts_at',
        ];
    }
    public function messages()
    {
        return [
            'expires_at.after' => 'The expiration date must be after the start date.',
        ];
    }
}

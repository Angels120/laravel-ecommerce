<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'phone_number' => ['required', 'string', 'max:10'],
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => ['required','confirmed', Password::min(8)->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()],
            'password_confirmation' => 'required|same:password',
            'verify' => 'nullable',
        ];
    }
}

<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Password implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $uppercase = preg_match('/[A-Z]/', $value);
        $lowercase = preg_match('/[a-z]/', $value);
        $number = preg_match('/[0-9]/', $value);
        $specialChars = preg_match('/[!@#$%^&*]/', $value);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($value) < 8) {
           $fail('The :Password must be 1 Uppercase 1 lowecase 1 number 1 special charactes and more than 8 letters');
       }
    }
}

<?php

namespace App\Rules\User;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordFormatValidation implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        if (strlen($value < 7)) {
            $fail(':attribute minimum 7 character');
        }
    }
}

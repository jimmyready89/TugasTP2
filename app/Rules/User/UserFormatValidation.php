<?php

namespace App\Rules\User;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserFormatValidation implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        if (strlen($value < 5)) {
            $fail(':attribute minimum 5 character');
        }
    }
}

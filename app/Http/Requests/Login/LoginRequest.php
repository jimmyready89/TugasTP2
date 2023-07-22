<?php

namespace App\Http\Requests\Login;

use App\Custome\RequestForm;
use App\Rules\User\{
    UserFormatValidation,
    PasswordFormatValidation
};

class LoginRequest extends RequestForm
{
    public function rules(): array
    {
        return [
            "username" => ["required", new UserFormatValidation],
            "password" => ["required", new PasswordFormatValidation],
        ];
    }

    public function messages(): array {
        return [
            'required' => ':attribute is required',
        ];
    }

    public function attributes(): array {
        return [
            "Username" => "Username",
            "Password" => "Password",
        ];
    }
}

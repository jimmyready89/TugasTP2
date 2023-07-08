<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\User\{
    UserFormatValidation,
    PasswordFormatValidation
};

class LoginRequest extends FormRequest
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

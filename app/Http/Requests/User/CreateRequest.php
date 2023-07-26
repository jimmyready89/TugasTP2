<?php

namespace App\Http\Requests\User;

use App\Custome\RequestForm;
use App\Rules\User\{
    UserFormatValidation,
    PasswordFormatValidation
};

class CreateRequest extends RequestForm
{
    public function rules(): array
    {
        return [
            "username" => ["required", new UserFormatValidation],
            "password" => ["required", new PasswordFormatValidation],
            "real_name" => ["required", "string"],
            "email" => ["required", "email"]
        ];
    }

    public function messages(): array {
        return [
            'required' => ':attribute is required',
            'string' => ':attribute must be string',
            'email' => ':attribute invalid email format',
        ];
    }

    public function attributes(): array {
        return [
            "Username" => "Username",
            "Password" => "Password",
            "email" => "Email",
            "realname" => "Real Name",
        ];
    }
}

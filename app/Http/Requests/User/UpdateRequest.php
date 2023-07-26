<?php

namespace App\Http\Requests\User;

use App\Custome\RequestForm;
use App\Rules\User\{
    UserFormatValidation,
    PasswordFormatValidation
};

class UpdateRequest extends RequestForm
{
    public function rules(): array
    {
        return [
            "realname" => ["required", "string"],
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
            "email" => "Email",
            "realname" => "Real Name",
        ];
    }
}

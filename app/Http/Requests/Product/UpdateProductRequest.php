<?php

namespace App\Http\Requests\Product;

use App\Custome\RequestForm;

class UpdateProductRequest extends RequestForm
{
    public function rules(): array
    {
        return [
            "sku" => ["required", "string"],
            "nama" => ["required", "string"],
        ];
    }

    public function messages(): array {
        return [
            "required" => ":attribute is required",
            "string" => ":attribute must be string",
        ];
    }

    public function attributes(): array {
        return [
            "sku" => "Sku",
            "nama" => "Nama",
        ];
    }
}

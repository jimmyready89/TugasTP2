<?php

namespace App\Http\Requests\Invoice;

use App\Custome\RequestForm;

class AddProductRequest extends RequestForm
{
    public function rules(): array
    {
        return [
            "product_id" => ["required", "numeric", "min:1"],
            "count" => ["required", "numeric", "min:1"],
        ];
    }

    public function messages(): array {
        return [
            "required" => ":attirbute is required",
            "numeric" => ":attribute must be numeric",
            "min" => ":attribute minimum :min",
        ];
    }

    public function attributes(): array {
        return [
            "product_id" => "Product",
            "count" => "Count",
        ];
    }
}

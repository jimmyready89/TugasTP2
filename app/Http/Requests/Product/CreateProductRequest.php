<?php

namespace App\Http\Requests\Product;

use App\Custome\RequestForm;

class CreateProductRequest extends RequestForm
{
    public function rules(): array
    {
        return [
            "sku" => ["required", "string"],
            "nama" => ["required", "string"],
            "price_per_unit" => ["required", "decimal:2", "min:1"],
            "valid_date" => ["required", "date_format:Y-m-d"]
        ];
    }

    public function messages(): array {
        return [
            "required" => ":attribute is required",
            "string" => ":attribute must be string",
            "date_format" => ":attribute invalid date format",
            "min" => ":attribute minimum is :min",
            "decimal" => ":attribute invalid format"
        ];
    }

    public function attributes(): array {
        return [
            "sku" => "Sku",
            "nama" => "Nama",
            "price_per_unit" => "Price Per Unit",
            "valid_date" => "Valid Date"
        ];
    }
}

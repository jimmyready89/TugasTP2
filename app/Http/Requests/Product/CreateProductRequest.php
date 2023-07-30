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
            "price_per_unit" => ["required", "numeric", "decimal:2"],
            "valid_date" => ["required", "date_format:Y-m-d"] 
        ];
    }

    public function message(): array {
        return [
            "required" => ":attribute is required",
            "string" => ":attribute must be string",
            "numeric" => ":attribute must be number",
            "valid_date" => ":attribute invalid date format"
        ];
    }

    public function attributes(): array {
        return [
            "sku" => "Sku",
            "nama" => "Nama",
            "price_per_unit" => "Price_Per_Unit",
            "valid_date" => "Valid_Date"
        ];
    }
}

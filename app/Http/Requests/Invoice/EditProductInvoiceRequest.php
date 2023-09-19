<?php

namespace App\Http\Requests\Invoice;

use App\Custome\RequestForm;

class EditProductInvoiceRequest extends RequestForm
{
    public function rules(): array
    {
        return [
            "count" => ["required", "numeric", "min:1"],
        ];
    }

    public function messages(): array {
        return [
            "required" => "attribute is required",
            "numeric" => ":attribute must be numeric",
            "min" => ":attribute minimum :min",
        ];
    }

    public function attributes(): array {
        return [
            "count" => "Count",
        ];
    }
}

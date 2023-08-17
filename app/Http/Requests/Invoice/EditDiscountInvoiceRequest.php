<?php

namespace App\Http\Requests\Invoice;

use App\Custome\RequestForm;

class EditDiscountInvoiceRequest extends RequestForm
{
    public function rules(): array
    {
        return [
            "discount_percent" => ["nullable", "decimal:2", "min:0", "max:100"]
        ];
    }

    public function messages(): array {
        return [
            "decimal" => ":attribute invalid format",
            "min" => ":attribute minimum discount :min",
            "max" => ":attribute maximum discount :max"
        ];
    }

    public function attributes(): array {
        return [
            "discount_percent" => "Discount Percent"
        ];
    }
}

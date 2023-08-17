<?php

namespace App\Http\Requests\Invoice;

use App\Custome\RequestForm;

class EditInvoiceRequest extends RequestForm
{
    public function rules(): array
    {
        return [
            "no_invoice" => ["required", "string"],
            "customer_name" => ["required", "string"],
            "date" => ["required", "date_format:Y-m-d"],
        ];
    }

    public function messages(): array {
        return [
            "required" => ":attirbute is required",
            "date_format" => ":attribute invalid date format"
        ];
    }

    public function attributes(): array {
        return [
            "no_invoice" => "No Invoice",
            "customer_name" => "Customer Name",
            "date" => "Date"
        ];
    }
}

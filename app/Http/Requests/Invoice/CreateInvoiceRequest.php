<?php

namespace App\Http\Requests\Invoice;

use App\Custome\RequestForm;

class CreateInvoiceRequest extends RequestForm
{
    public function rules(): array
    {
        return [
            "no_invoice" => ["nullable", "string"],
            "customer_name" => ["nullable", "string"],
            "date" => ["required", "date_format:Y-m-d"]
        ];
    }

    public function message(): array {
        return [
            "string" => ":attribute must be string",
            "date_format" => ":attribute invalid date format",
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

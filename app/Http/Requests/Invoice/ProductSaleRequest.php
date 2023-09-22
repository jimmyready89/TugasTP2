<?php

namespace App\Http\Requests\Invoice;

use App\Custome\RequestForm;

class ProductSaleRequest extends RequestForm
{
    public function rules(): array
    {
        return [
            "Parm" => [],
        ];
    }

    public function messages(): array {
        return [];
    }

    public function attributes(): array {
        return [];
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice\InvoiceModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function Index(): JsonResponse {
        $InvoiceList = InvoiceModel::select('id', 'no_invoice', 'customer_name', 'date')->get();

        return $this->sendResponse(result:[
            "invoice_list" => $InvoiceList
        ]);
    }
}

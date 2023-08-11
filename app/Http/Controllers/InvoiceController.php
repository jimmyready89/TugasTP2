<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice\InvoiceModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Invoice\{
    CreateInvoiceRequest
};

class InvoiceController extends Controller
{
    public function Index(): JsonResponse {
        $InvoiceList = [];
        $UserId = Auth()->id();

        $InvoiceList = InvoiceModel::select('id', 'no_invoice', 'customer_name', 'date')->get();

        return $this->sendResponse(result:[
            "invoice_list" => $InvoiceList
        ]);
    }

    public function Create(CreateInvoiceRequest $Request): JsonResponse {
        $NoInvoice = $Request->no_invoice ?? '';
        $CustomerName = $Request->customer_name ?? '';
        $Date = $Request->date;
        $UserId = Auth()->id();
        
        // jika no_invoice nya kosong tidak perlu di validasi
        try {
            if ($NoInvoice !== '') {
                $InvoiceExist = InvoiceModel::where([
                    'no_invoice' => $NoInvoice
                ])->exists();
                if ($InvoiceExist) {
                    throw new \Exception("Number invoice has been already use");
                }
            }
            $Invoice = InvoiceModel::create([
                'no_invoice' => $NoInvoice,
                'customer_name' => $CustomerName,
                'date' => $Date,
                'usercreate_id' => $UserId,
                'userupdate_id' => $UserId
            ]);

            $Message[] = "Create Invoice Success";
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
        }

        return $this->sendResponse(result:[
            "InvoiceId" => $Invoice->id
        ], message: $Message);
    }
}

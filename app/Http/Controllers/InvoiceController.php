<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice\InvoiceModel;
use App\Models\Product\ProductModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Invoice\EditInvoiceRequest;
use App\Http\Requests\Invoice\{
    CreateInvoiceRequest,
    EditInvoiceRequest
};

class InvoiceController extends Controller
{
    public function Index(): JsonResponse {
        $InvoiceList = [];

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

    public function AddProduct(Request $Request, int $Id): JsonResponse {
        $ProductId = $Request->product_id;
        $UserId = Auth()->id();

        try {
            $Invoice = InvoiceModel::find($Id);
            if (!$Invoice) {
                throw new \Exception("Invalid invoice");
            }

            $Product = ProductModel::find($ProductId);
            if (!$Product) {
                throw new \Exception("Invalid product");
            }
            
            $ProductPrice = $Product->PriceValidByDate($Invoice->date);
            if ($ProductPrice <= 0) {
                throw new \Exception("Invalid Price product");
            }

            $InvoiceProduct = $Invoice->ProductList()->create([
                'sku' => $Product->sku,
                'nama' => $Product->nama,
                'price_per_unit' => $ProductPrice,
                'userupdate_id' => $UserId
            ]);

            $Message[] = "Add Product Success";
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
        }

        return $this->sendResponse(result:[
            "InvoiceId" => $InvoiceProduct->id
        ], message: $Message);
    }

    public function EditInvoice(EditInvoiceRequest $Request, int $Id) {
        $NoInvoice = $Request->no_invoice;
        $CustomerName = $Request->customer_name;
        $Date = $Request->date;
        $UserId = Auth()->id();

        try {
            $Invoice = InvoiceModel::find($Id);
            if (!$Invoice) {
                throw new \Exception('Invoice Id Invalid');
            }

            $InvoiceData = InvoiceModel::where([
                'no_invoice' => $NoInvoice,
            ])->exists();
            if ($InvoiceData) {
                throw new \Exception('No Invoice has been already use');
            }
    
            $Invoice->no_invoice = $NoInvoice;
            $Invoice->customer_name = $CustomerName;
            $Invoice->date = $Date;
            $Invoice->userupdate_id = $UserId;

            if ($Invoice->isClean(['no_invoice', 'customer_name', 'date'])) {
                throw new \Exception('No Change');
            }
    
            $Invoice->save();
    
            $Message[] = "Edit Invoice Success";
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
        }

        return $this->sendResponse(message: $Message);
    }

    public function RemoveProduct(int $Id, int $ProductId) {
        
        try {
            $Invoice = InvoiceModel::find($Id);
            if (!$Invoice) {
                throw new \Exception("Invoice product not found");
            }
            
            $InvoiceProduct = $Invoice->ProductList()->find($ProductId);
            if (!$InvoiceProduct) {
                throw new \Exception("Invoice Prodcut not found");
            }

            // Menghapus InvoiceProductModel itu sendiri
            $InvoiceProduct->delete();
    
            $Message[] = "Remove Product Success";
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();
    
            return $this->sendError(message: $Message);
        }
    
        return $this->sendResponse(message: $Message);
    }

    public function ProductList(int $Id) {
        $ProductList = [];

        try {
            $Invoice = InvoiceModel::find($Id);
            if (!$Invoice) {
                throw new \Exception("Invoice not found");
            }

            $ProductList = $Invoice->ProductList()->select(["id", "nama", "sku", "price_per_unit"])->get();
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();
    
            return $this->sendError(message: $Message);
        }

        return $this->sendResponse(result:[
            "prodcut_list" => $ProductList
        ]);
    }
}

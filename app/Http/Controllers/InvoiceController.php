<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice\InvoiceModel;
use App\Models\Product\ProductModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Invoice\{
    CreateInvoiceRequest,
    EditInvoiceRequest,
    EditDiscountInvoiceRequest,
    AddProductRequest
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

    public function Detail(int $Id): JsonResponse {
        $NoInvoice = "";
        $CustomerName = "";
        $Date = "";
        $DiscountPercent = 0;
        $DiscountAmount = 0;
        $TotalPrice = 0;
        $SubTotal = 0;

        try {
            $Invoice = InvoiceModel::find($Id);
            if (!$Invoice) {
                throw new \Exception("Invalid invoice");
            }

            $NoInvoice = $Invoice->no_invoice;
            $CustomerName = $Invoice->customer_name;
            $Date = $Invoice->date->format("d-M-Y");

            $InvoiceTotalPrice = $Invoice->InvoiceTotalPrice;

            $SubTotal = $InvoiceTotalPrice->total_price ?? 0;
            $DiscountPercent = $InvoiceTotalPrice->discount_percent ?? 0;
            $DiscountAmount = $InvoiceTotalPrice->discount_amount ?? 0;
            $TotalPrice = $InvoiceTotalPrice->total_price_after_discount ?? 0;
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
        }

        return $this->sendResponse(result:[
            "no_invoice" => $NoInvoice,
            "customer_name" => $CustomerName,
            "date" => $Date,
            "price" => [
                "subtotal" => $SubTotal,
                "discount" => [
                    "percent" => $DiscountPercent,
                    "amount" => $DiscountAmount
                ],
                "total" => $TotalPrice
            ]
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

    public function AddProduct(AddProductRequest $Request, int $Id): JsonResponse {
        $ProductId = $Request->product_id;
        $Count = $Request->count;
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

            $InvoiceProductExists = $Invoice->ProductList()->where([
                "sku" => $Product->sku
            ])->exists();

            if ($InvoiceProductExists) {
                throw new \Exception("Product Already Added");
            }
            
            $ProductPrice = $Product->PriceValidByDate($Invoice->date);
            if ($ProductPrice <= 0) {
                throw new \Exception("Invalid Price product");
            }

            $InvoiceProduct = $Invoice->ProductList()->create([
                'sku' => $Product->sku,
                'nama' => $Product->nama,
                'price_per_unit' => $ProductPrice,
                'count' => $Count,
                'userupdate_id' => $UserId
            ]);

            $Invoice->UpdateTotalPrice($UserId);

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
                ['no_invoice', '=', $NoInvoice],
                ['id', '<>', $Id]
            ])
            ->exists();
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

    public function EditDiscountInvoice(EditDiscountInvoiceRequest $Request, int $Id) {
        $DiscountPercent = $Request->discount_percent;
        if (!($DiscountPercent > 0)) {
            $DiscountPercent = 0;
        }
        $UserId = Auth()->id();

        try {
            $Invoice = InvoiceModel::find($Id);
            if (!$Invoice) {
                throw new \Exception('Invoice Id Invalid');
            }

            $Invoice->UpdateTotalPrice($UserId, $DiscountPercent);

            $Message[] = "Edit Discount Success";
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
        }

        return $this->sendResponse(message: $Message);
    }

    public function RemoveProduct(int $Id, int $ProductId) {
        $UserId = Auth()->id();

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
            
            $Invoice->UpdateTotalPrice($UserId);

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

            $ProductList = $Invoice->ProductList()->select([
                "id",
                "nama",
                "sku",
                "count",
                "price_per_unit",
                \DB::raw("price_per_unit * count as total")
            ])->get();
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();
    
            return $this->sendError(message: $Message);
        }

        return $this->sendResponse(result:[
            "prodcut_list" => $ProductList
        ]);
    }
}

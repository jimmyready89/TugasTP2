<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductModel;
use App\Models\Product\ProductPriceModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Product\{
    CreateProductRequest,
    UpdateProductRequest,
    AddPriceProductRequest,
    EditPriceProductRequest
};

class ProductController extends Controller
{
    public function Index(): JsonResponse {
        $ProductList = [];

        $ProductList = ProductModel::select('id', 'sku', 'nama')->get();

        return $this->sendResponse(result:[
            "product_list" => $ProductList
        ]);
    }

    public function Create(CreateProductRequest $Request): JsonResponse {
        $Sku = $Request->sku;
        $Nama = $Request->nama;
        $PricePerUnit = $Request->price_per_unit;
        $ValidateDate = $Request->valid_date;
        $UserId = Auth()->id();

        try {
            $ProductSkuExisting = ProductModel::where([
                "sku" => $Sku
            ])->exists();
            if ($ProductSkuExisting) {
                throw new \Exception("Sku has been already use");
            }

            $ProductNameExisting = ProductModel::where([
                'sku' => $Sku,
                "nama" => $Nama
            ])->exists();
            if ($ProductNameExisting) {
                throw new \Exception("Nama has been already use");
            }

            $Product = ProductModel::create([
                'sku' => $Sku,
                'nama' => $Nama,
                'usercreate_id' => $UserId,
                'userupdate_id' => $UserId
            ]);

            $Product->Price()->Create([
                'price_per_unit' => $PricePerUnit,
                'valid_date' => $ValidateDate,
                'usercreate_id' => $UserId,
                'userupdate_id' => $UserId
            ]);

            $Message[] = "Create Product Success";
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
        }

        return $this->sendResponse(result:[
            "ProductId" => $Product->id
        ], message: $Message);
    }

    public function ProductDetail(int $Id): JsonResponse {
        $ProductData = [];

        try {
            $Product = ProductModel::find($Id);
            if ($Product === null) {
                throw new \Exception('Product Id Invalid');
            }

            $ProductData["nama"] = $Product->nama;
            $ProductData["sku"] = $Product->sku;
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
        }
       
        return $this->sendResponse($ProductData);
    }

    public function ProductUpdate(UpdateProductRequest $Request, int $Id): JsonResponse {
        $ProductData = [];

        try {
            $Sku = $Request->sku;
            $Nama = $Request->nama;
            $UserId = Auth()->id();

            $Product = ProductModel::find($Id);
            if ($Product === null) {
                throw new \Exception('Product Id Invalid');
            }

            $ProductSkuExisting = ProductModel::where([
                ["sku", "=", $Sku],
                ["id", "<>", $Id]
            ])->exists();
            if ($ProductSkuExisting) {
                throw new \Exception("Sku has been already use");
            }

            $ProductNameExisting = ProductModel::where([
                ["sku", "=", $Sku],
                ["nama", "=", $Nama],
                ["id", "<>", $Id]
            ])->exists();
            if ($ProductNameExisting) {
                throw new \Exception("Nama has been already use");
            }

            $Product->sku = $Sku;
            $Product->nama = $Nama;
            $Product->userupdate_id = $UserId;

            if ($Product->isClean(['sku', 'nama'])) {
                throw new \Exception("No Change");
            }

            $Product->save();

            $Message[] = "Update Success";
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
        }

        return $this->sendResponse(message: $Message);
    }

    public function ProductPrice(int $Id): JsonResponse {
        $PriceList = [];

        try {
            $Product = ProductModel::find($Id);
            if ($Product === null) {
                throw new \Exception('Product Id Invalid');
            }

            $PriceList = $Product->Price
                ->setVisible(['id', 'price_per_unit', 'valid_date'])
                ->toArray();
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
        }

        return $this->sendResponse([
            "price_list" => $PriceList
        ]);
    }
  
    public function AddPrice(AddPriceProductRequest $Request, int $Id): JsonResponse {

        try {
            $PricePerUnit = $Request->price_per_unit;
            $ValidDate = $Request->valid_date;
            $UserId = Auth()->id();

            $Product = ProductModel::find($Id);

            if ($Product === null) {
                throw new \Exception('Product Id Invalid');
            }

            $Product->Price()->Create([
                'price_per_unit' => $PricePerUnit,
                'valid_date' => $ValidDate,
                'usercreate_id' => $UserId,
                'userupdate_id' => $UserId
            ]);

            $Message[] = "Add Price Success";
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
        }

        return $this->sendResponse(message: $Message);
    }

    public function EditPrice(EditPriceProductRequest $Request, int $Id, int $PriceId): JsonResponse {
        try {
            $PricePerUnit = $Request->price_per_unit;
            $ValidDate = $Request->valid_date;
            $UserId = Auth()->id();

            // Ambil id spesifik dari table ProductModel
            $Product = ProductModel::find($Id);
            if (!$Product) {
                throw new \Exception('Product Price Id Invalid');
            }

            // Ambil id spesifik dari table ProductPriceModel
            $ProductPrice = ProductPriceModel::find($Id);

            // Ambil id spesifik dari table ProductModel
            $Product = ProductModel::find($Id);
            if (!$Product) {
                throw new \Exception('Product Id Invalid');
            }

            // Ambil id spesifik dari table ProductPriceModel
            $ProductPrice = $Product->Price()->find($PriceId);
    
            if (!$ProductPrice) {
                throw new \Exception('Product Price Id Invalid');
            }

            // Update data harga
            $ProductPrice->price_per_unit = $PricePerUnit;
            $ProductPrice->valid_date = $ValidDate;
            $ProductPrice->userupdate_id = $UserId;

            if ($ProductPrice->isClean(['price_per_unit', 'valid_date'])) {
                throw new \Exception("No Change");
            }

            $ProductPrice->save();

            $Message[] = "Edit Price Success";
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();
            return $this->sendError(message: $Message);
        }

        return $this->sendResponse(message: $Message);
    }

    public function RemovePrice(int $Id, int $PriceId): JsonResponse {
        try {
            // Ambil id spesifik dari table ProductModel
            $Product = ProductModel::find($Id);
            if (!$Product) {
                throw new \Exception('Product Price Id Invalid');
            }

            // Ambil id spesifik dari table ProductPriceModel
            $ProductPrice = $Product->Price()->find($PriceId);
    
            if (!$ProductPrice) {
                throw new \Exception('Product Price Id Invalid');
            }
    
            $ProductPrice->delete();
    
            $Message[] = "Product Price Remove Success";
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();
            return $this->sendError(message: $Message);
        }
    
        return $this->sendResponse(message: $Message);
    }
}

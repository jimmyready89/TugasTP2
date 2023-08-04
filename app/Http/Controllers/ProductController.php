<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Product\{
    CreateProductRequest,
    UpdateProductRequest
};

class ProductController extends Controller
{
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
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
        }

        try {
            $ProductNameExisting = ProductModel::where([
                'sku' => $Sku,
                "nama" => $Nama
            ])->exists();
            if ($ProductNameExisting) {
                throw new \Exception("Nama has been already use");
            }
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
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
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
        }

        $ProductData["nama"] = $Product->nama;
        $ProductData["sku"] = $Product->sku;
       
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
}

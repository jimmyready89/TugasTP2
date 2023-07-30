<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Product\{
    CreateProductRequest
};

class ProductController extends Controller
{
    public function Create(CreateProductRequest $Request): JsonResponse {
        $Sku = $Request->sku;
        $Nama = $Request->nama;
        $PricePerUnit = $Request->price_per_unit;
        $ValidateDate = $Request->validate_date;
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
            'valid_date' => now()->format("Y-m-d"),
            'usercreate_id' => $UserId,
            'userupdate_id' => $UserId
        ]);

        $Message[] = "Create Product Success";

        return $this->sendResponse(result:[
            "ProductId" => $Product->id
        ], message: $Message);
    }
}

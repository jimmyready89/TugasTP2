<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Invoice\InvoiceProductModel;
use App\Models\Invoice\InvoiceTotalPriceModel;

class InvoiceModel extends Model
{
    use HasFactory;

    protected $table = 'Invoice';
    protected $primaryKey = 'id';
    protected $fillable = [
        'no_invoice',
        'customer_name',
        'date',
        'usercreate_id',
        'userupdate_id'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function ProductList(): HasMany{
        return $this->hasMany(InvoiceProductModel::class, "invoice_id", "id");
    }

    public function InvoiceTotalPrice(): HasOne{
        return $this->HasOne(InvoiceTotalPriceModel::class, "invoice_id", "id");
    }
    
    public function UpdateTotalPrice(int $UserId, float $Discount = null): void{
        $TotalPrice = $this->ProductList()->sum("price_per_unit");
        if (!($TotalPrice > 0)) {
            $TotalPrice = 0;
        }

        $InvoiceTotalPriceModel = $this->InvoiceTotalPrice();
        $DiscountPercent = $InvoiceTotalPriceModel->discount_percent ?? 0;
        if ($Discount !== null) {
            $DiscountPercent = $Discount;
        }
        $DiscountAmount = ceil($TotalPrice * $DiscountPercent / 100);

        $TotalPriceAfterDiscount = $TotalPrice - $DiscountAmount;
        
        $this->InvoiceTotalPrice()->updateOrCreate(
            [],
            [
                'total_price' => $TotalPrice,
                'discount_percent' => $DiscountPercent,
                'discount_amount' => $DiscountAmount,
                'total_price_after_discount' => $TotalPriceAfterDiscount,
                'userupdate_id' => $UserId
            ]
        );

        return;
    }
}

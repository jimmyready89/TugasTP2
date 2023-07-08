<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceTotalPriceModel extends Model
{
    use HasFactory;

    protected $table = 'InvoiceTotalPrice';
    protected $primaryKey = 'invoice_id';
    protected $fillable = [
        'total_price',
        'discount_percent',
        'discount_amount',
        'total_price_after_discount',
        'userupdate_id'
    ];
}

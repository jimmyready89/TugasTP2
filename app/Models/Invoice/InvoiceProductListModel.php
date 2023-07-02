<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProductListModel extends Model
{
    use HasFactory;

    protected $table = 'InvoiceProductList';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'invoice_id',
        'invoice_product_id',
        'userupdate_id'
    ];
}

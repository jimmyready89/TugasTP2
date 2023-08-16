<?php

namespace App\Models\Invoice;

use App\Models\Invoice\InvoiceModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class InvoiceProductModel extends Model
{
    use HasFactory;

    protected $table = 'InvoiceProduct';
    protected $primaryKey = 'id';
    protected $fillable = [
        'invoice_id',
        'sku',
        'nama',
        'price_per_unit',
        'userupdate_id'
    ];
    protected $attributes = [
        'active' => 1
    ];

    public function Invoice(): HasOne{
        return $this->HasOne(InvoiceModel::class, 'id', 'invoice_id');
    }
}

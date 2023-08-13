<?php

namespace App\Models\Invoice;

use App\Models\Invoice\InvoiceProductListModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class InvoiceProductModel extends Model
{
    use HasFactory;

    protected $table = 'InvoiceProduct';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sku',
        'nama',
        'price_per_unit',
        'userupdate_id'
    ];
    protected $attributes = [
        'active' => 1
    ];

    public function Invoice(): HasMany{
        return $this->HasMany(InvoiceProductListModel::class, 'invoice_id', 'id');
    }
}

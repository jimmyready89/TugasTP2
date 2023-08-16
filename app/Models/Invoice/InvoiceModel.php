<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Invoice\InvoiceProductModel;

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
}

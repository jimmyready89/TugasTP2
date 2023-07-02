<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProductModel extends Model
{
    use HasFactory;

    protected $table = 'InvoiceProduct';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'sku',
        'nama',
        'price_per_unit',
        'userupdate_id'
    ];
    protected $attributes = [
        'active' => 1
    ];
}

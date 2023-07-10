<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceModel extends Model
{
    use HasFactory;

    protected $table = 'Invoice';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'no_invoice',
        'customer_name',
        'usercreate_id',
        'userupdate_id'
    ];
}

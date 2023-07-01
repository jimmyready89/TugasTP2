<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'Product';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sku',
        'nama',
        'create_date',
        'update_date',
        'usercreate_id',
        'userupdate_id'
    ];
}

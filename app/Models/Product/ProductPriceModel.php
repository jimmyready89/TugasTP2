<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPriceModel extends Model
{
    use HasFactory;

    protected $table = 'ProductPrice';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'price_per_unit',
        'valid_date',
        'usercreate_id',
        'userupdate_id'
    ];
}

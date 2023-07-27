<?php

namespace App\Models\Product;

use App\Models\Product\ProductPriceModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'Product';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sku',
        'nama',
        'usercreate_id',
        'userupdate_id'
    ];

    public function Price(): HasMany{
        return $this->HasMany(ProductPriceModel::class, 'product_id', 'id');
    }

}

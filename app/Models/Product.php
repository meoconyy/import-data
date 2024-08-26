<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'short_name',
        'name',
        'product_id',
        'unit_1',
        'unit_2',
        'factor_1',
        'unit_3',
        'factor_2',
        'purchase_price',
        'sale_price',
        'declared_price',
        'cost_goods_sold',
        'list_price',
        'specific_cost',
        'hapu_price',
        'hapu_price_update_date',
        'min_sale_price',
        'max_sale_price',
        'quality_registration_number',
        'specification',
        'storage_code',
        'storage_location',
        'position',
        'product_type',
        'classification',
        'product_group',
    ];
}

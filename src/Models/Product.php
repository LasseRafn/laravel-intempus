<?php

namespace LasseRafn\LaravelIntempus\Models;

use LasseRafn\LaravelIntempus\Utils\Model;

class Product extends Model
{
    protected $entity = 'Product';
    protected $fillable = [
        'accessible',
        'available',
        'bar_code',
        'cost_price',
        'description',
        'id',
        'in_stock',
        'logical_timestamp',
        'name',
        'number',
        'on_order',
        'ordered',
        'product_group_id',
        'recommended_price',
        'sales_price',
        'unit',
        'uuid',
        'volume',
    ];

    public $accessible;
    public $available;
    public $bar_code;
    public $cost_price;
    public $description;
    public $id;
    public $in_stock;
    public $logical_timestamp;
    public $name;
    public $number;
    public $on_order;
    public $ordered;
    public $product_group_id;
    public $recommended_price;
    public $sales_price;
    public $unit;
    public $uuid;
    public $volume;
}

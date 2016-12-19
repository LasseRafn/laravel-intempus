<?php namespace LasseRafn\LaravelIntempus\Builders;

use LasseRafn\LaravelIntempus\Models\Product;

class ProductBuilder extends Builder
{
    protected $entity = 'Product';
    protected $model = Product::class;
}

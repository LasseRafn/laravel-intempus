<?php namespace LasseRafn\LaravelIntempus\Builders;

use LasseRafn\LaravelIntempus\Models\CustomerGroup;

class CustomerGroupBuilder extends Builder
{
    protected $entity = 'CustomerGroup';
    protected $model = CustomerGroup::class;
}

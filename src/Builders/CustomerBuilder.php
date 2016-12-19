<?php namespace LasseRafn\LaravelIntempus\Builders;

use LasseRafn\LaravelIntempus\Models\Customer;

class CustomerBuilder extends Builder
{
    protected $entity = 'Customer';
    protected $model = Customer::class;
}

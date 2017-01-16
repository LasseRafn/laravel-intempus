<?php

namespace LasseRafn\LaravelIntempus\Builders;

use LasseRafn\LaravelIntempus\Models\Contract;

class ContractBuilder extends Builder
{
    protected $entity = 'Contract';
    protected $model = Contract::class;
}

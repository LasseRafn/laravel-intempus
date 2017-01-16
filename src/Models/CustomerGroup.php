<?php

namespace LasseRafn\LaravelIntempus\Models;

use LasseRafn\LaravelIntempus\Utils\Model;

class CustomerGroup extends Model
{
    protected $entity = 'CustomerGroup';
    protected $fillable = [
        'company_id',
        'id',
        'logical_timestamp',
        'name',
        'number',
        'uuid',
    ];

    public $company_id;
    public $id;
    public $logical_timestamp;
    public $name;
    public $number;
    public $uuid;
}

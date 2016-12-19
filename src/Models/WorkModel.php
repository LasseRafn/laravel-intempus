<?php namespace LasseRafn\LaravelIntempus\Models;

use LasseRafn\LaravelIntempus\Utils\Model;

class WorkModel extends Model
{
    protected $entity   = 'WorkModel';
    protected $fillable = [
        'id',
        'default_hourly_wage',
        'company_id',
        'lieu_balance_transfer_worktype_id',
        'logical_timestamp',
        'number',
        'name',
        'uuid',
    ];

    public $id;
    public $default_hourly_wage;
    public $company_id;
    public $lieu_balance_transfer_worktype_id;
    public $logical_timestamp;
    public $number;
    public $uuid;
    public $name;
}

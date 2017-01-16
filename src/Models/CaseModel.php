<?php

namespace LasseRafn\LaravelIntempus\Models;

use LasseRafn\LaravelIntempus\Utils\Model;
use LasseRafn\LaravelIntempus\Builders\CustomerBuilder;

class CaseModel extends Model
{
    protected $entity = 'Case';
    protected $fillable = [
        'active',
        'all_employees_may_add_work_reports',
        'all_worktypes_may_used_in_work_reports',
        'auto_numbered',
        'case_group_id',
        'case_state_id',
        'city',
        'co_responsible_id',
        'country',
        'creation_date',
        'customer_id',
        'end_date',
        'hour_budget',
        'id',
        'logical_timestamp',
        'name',
        'notes',
        'number',
        'parent_id',
        'permit_new_workreports',
        'responsible_id',
        'start_date',
        'street_address',
        'uuid',
        'zip_code',
    ];

    public $active;
    public $all_employees_may_add_work_reports;
    public $all_worktypes_may_used_in_work_reports;
    public $auto_numbered;
    public $case_group_id;
    public $case_state_id;
    public $city;
    public $co_responsible_id;
    public $country;
    public $creation_date;
    public $customer_id;
    public $end_date;
    public $hour_budget;
    public $id;
    public $logical_timestamp;
    public $name;
    public $notes;
    public $number;
    public $parent_id;
    public $permit_new_workreports;
    public $responsible_id;
    public $start_date;
    public $street_address;
    public $uuid;
    public $zip_code;

    /**
     * @return Customer
     */
    public function customer()
    {
        return ( new CustomerBuilder($this->request) )->find($this->customer_id);
    }
}

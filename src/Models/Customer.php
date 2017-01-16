<?php

namespace LasseRafn\LaravelIntempus\Models;

use LasseRafn\LaravelIntempus\Utils\Model;

class Customer extends Model
{
    protected $entity = 'Customer';
    protected $fillable = [
        'city',
        'company_id',
        'contact',
        'country',
        'customer_group_id',
        'email',
        'id',
        'logical_timestamp',
        'name',
        'notes',
        'number',
        'phone',
        'street_address',
        'uuid',
        'zip_code',
    ];

    public $city;
    public $company_id;
    public $contact;
    public $country;
    public $customer_group_id;
    public $email;
    public $id;
    public $logical_timestamp;
    public $name;
    public $notes;
    public $number;
    public $phone;
    public $street_address;
    public $uuid;
    public $zip_code;
}

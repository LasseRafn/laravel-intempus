<?php namespace LasseRafn\LaravelIntempus\Models;

use LasseRafn\LaravelIntempus\Utils\Model;

class Employee extends Model
{
	protected $entity   = 'Employee';
	protected $fillable = [
		'car_registration_number',
		'city',
		'co_responsible_id',
		'company_id',
		'country',
		'cpr_number',
		'email',
		'file_server_auth_hash',
		'id',
		'logical_timestamp',
		'may_CUD_customers_and_cases',
		'may_add_work_reports_to_all_cases',
		'name',
		'number',
		'phone',
		'responsible_id',
		'street_address',
		'uuid',
		'wipe_native_clients_logged_in_before',
		'zip_code',
	];

	public $car_registration_number;
	public $city;
	public $co_responsible_id;
	public $company_id;
	public $country;
	public $cpr_number;
	public $email;
	public $file_server_auth_hash;
	public $id;
	public $logical_timestamp;
	public $may_CUD_customers_and_cases;
	public $may_add_work_reports_to_all_cases;
	public $name;
	public $number;
	public $phone;
	public $responsible_id;
	public $street_address;
	public $uuid;
	public $wipe_native_clients_logged_in_before;
	public $zip_code;
}

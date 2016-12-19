<?php namespace LasseRafn\LaravelIntempus\Models;

use LasseRafn\LaravelIntempus\Utils\Model;

class EmployeeCaseRule extends Model
{
	protected $entity   = 'EmployeeCaseRules';
	protected $fillable = [
		'case_id',
		'employee_id',
		'id',
		'logical_timestamp',
		'uuid'
	];

	public $case_id;
	public $employee_id;
	public $id;
	public $logical_timestamp;
	public $uuid;
}

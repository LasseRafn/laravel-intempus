<?php namespace LasseRafn\LaravelIntempus\Models;

use LasseRafn\LaravelIntempus\Utils\Model;

class CaseGroup extends Model
{
	protected $entity   = 'CaseGroup';
	protected $fillable = [
		'company_id',
		'id',
		'logical_timestamp',
		'name',
		'number',
		'uuid'
	];

	public $company_id;
	public $id;
	public $logical_timestamp;
	public $name;
	public $number;
	public $uuid;
}

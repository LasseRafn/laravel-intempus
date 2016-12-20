<?php namespace LasseRafn\LaravelIntempus\Models;

use LasseRafn\LaravelIntempus\Utils\Model;

class WorkReport extends Model
{
	protected $entity   = 'WorkReport';
	protected $fillable = [
		'amount',
		'approved',
		'case_id',
		'contract_id',
		'creation_id',
		'end_date',
		'end_time',
		'product_id',
		'remarks',
		'start_date',
		'start_time',
		'work_type_id',
	];

	public $amount;
	public $approved;
	public $case_id;
	public $contract_id;
	public $creation_id;
	public $end_date;
	public $end_time;
	public $product_id;
	public $remarks;
	public $start_date;
	public $start_time;
	public $work_type_id;
}

<?php namespace LasseRafn\LaravelIntempus\Models;

use LasseRafn\LaravelIntempus\Utils\Model;

class WorkType extends Model
{
	protected $entity   = 'WorkType';
	protected $fillable = [
		'active',
		'amount_cutoff',
		'bill_as_product_id',
		'date_interval',
		'factor',
		'id',
		'input_type',
		'lieu_factor',
		'logical_timestamp',
		'name',
		'piece_work',
		'report_interval',
		'unit_cost',
		'uuid',
		'work_category_id'
	];

	public $active;
	public $amount_cutoff;
	public $bill_as_product_id;
	public $date_interval;
	public $factor;
	public $id;
	public $input_type;
	public $lieu_factor;
	public $logical_timestamp;
	public $name;
	public $piece_work;
	public $report_interval;
	public $unit_cost;
	public $uuid;
	public $work_category_id;
}

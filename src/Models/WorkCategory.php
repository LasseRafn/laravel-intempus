<?php namespace LasseRafn\LaravelIntempus\Models;

use LasseRafn\LaravelIntempus\Utils\Model;

class WorkCategory extends Model
{
	protected $entity   = 'WorkCategory';
	protected $fillable = [
		'case_related',
		'hue',
		'id',
		'logical_timestamp',
		'name',
		'supplement',
		'uuid',
		'work_model_id',
	];

	public $case_related;
	public $hue;
	public $id;
	public $logical_timestamp;
	public $name;
	public $supplement;
	public $uuid;
	public $work_model_id;
}

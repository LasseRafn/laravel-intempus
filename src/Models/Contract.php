<?php namespace LasseRafn\LaravelIntempus\Models;

use LasseRafn\LaravelIntempus\Builders\EmployeeBuilder;
use LasseRafn\LaravelIntempus\Utils\Model;

class Contract extends Model
{
	protected $entity   = 'Contract';
	protected $fillable = [
		'compute_negative_overtime',
		'employee_id',
		'end_date',
		'hourly_wage',
		'id',
		'lieu_balance_as_work_report_id',
		'locked_date',
		'logical_timestamp',
		'prescribed_hours_messages_enabled',
		'start_date',
		'uuid',
		'work_model_id',
		'working_hours_agreement_id',
	];

	public $compute_negative_overtime;
	public $employee_id;
	public $end_date;
	public $hourly_wage;
	public $id;
	public $lieu_balance_as_work_report_id;
	public $locked_date;
	public $logical_timestamp;
	public $prescribed_hours_messages_enabled;
	public $start_date;
	public $uuid;
	public $work_model_id;
	public $working_hours_agreement_id;

	/**
	 * @return Employee
	 */
	public function employee()
	{
		return (new EmployeeBuilder($this->request))->find($this->employee_id);
	}
}

<?php

namespace LasseRafn\LaravelIntempus\Models;

use LasseRafn\LaravelIntempus\Utils\Model;
use LasseRafn\LaravelIntempus\Builders\CaseBuilder;
use LasseRafn\LaravelIntempus\Builders\ProductBuilder;
use LasseRafn\LaravelIntempus\Builders\ContractBuilder;

class WorkReport extends Model
{
    protected $entity = 'WorkReport';
    protected $fillable = [
        'id',
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
        'uuid',
        'creation_datetime',
        'logical_timestamp',
    ];

    public $id;
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
    public $uuid;
    public $creation_datetime;
    public $logical_timestamp;

    /**
     * @return CaseModel
     */
    public function case()
    {
        return ( new CaseBuilder($this->request) )->find($this->case_id);
    }

    /**
     * @return Contract
     */
    public function contract()
    {
        return ( new ContractBuilder($this->request) )->find($this->contract_id);
    }

    /**
     * @return Product
     */
    public function product()
    {
        return ( new ProductBuilder($this->request) )->find($this->product_id);
    }

    /**
     * @return Employee
     */
    public function employee()
    {
        return $this->contract()->employee();
    }
}

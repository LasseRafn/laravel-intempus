<?php namespace LasseRafn\LaravelIntempus\Builders;

use LasseRafn\LaravelIntempus\Models\Employee;

class EmployeeBuilder extends Builder
{
    protected $entity = 'Employee';
    protected $model = Employee::class;
}

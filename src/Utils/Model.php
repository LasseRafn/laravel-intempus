<?php

namespace LasseRafn\LaravelIntempus\Utils;

class Model
{
    protected $entity;
    protected $primaryKey;
    protected $modelClass = self::class;
    protected $fillable = [];

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request, $data = [])
    {
        $this->request = $request;

        foreach ($this->fillable as $fillable) {
            if (is_array($data) && isset($data[$fillable])) {
                if (! method_exists($this, 'set'.ucfirst(camel_case($fillable)).'Attribute')) {
                    $this->setAttribute($fillable, $data[$fillable]);
                } else {
                    $this->setAttribute($fillable, $this->{'set'.ucfirst(camel_case($fillable)).'Attribute'}($data[$fillable]));
                }
            } elseif (is_object($data) && isset($data->{$fillable})) {
                if (! method_exists($this, 'set'.ucfirst(camel_case($fillable)).'Attribute')) {
                    $this->setAttribute($fillable, $data->{$fillable});
                } else {
                    $this->setAttribute($fillable, $this->{'set'.ucfirst(camel_case($fillable)).'Attribute'}($data->{$fillable}));
                }
            }
        }
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }

    public function toArray()
    {
        $data = [];

        foreach ($this->fillable as $fillable) {
            if (isset($this->{$fillable})) {
                $data[$fillable] = $this->{$fillable};
            }
        }

        return $data;
    }

    protected function setAttribute($attribute, $value)
    {
        $this->{$attribute} = $value;
    }

    // todo allow updating + deleting
}

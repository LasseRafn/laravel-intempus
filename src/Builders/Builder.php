<?php namespace LasseRafn\LaravelIntempus\Builders;

use LasseRafn\LaravelIntempus\Utils\Model;
use LasseRafn\LaravelIntempus\Utils\Request;

class Builder
{
    private $request;
    protected $entity;

    /** @var Model */
    protected $model;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $id
     *
     * @return mixed|Model
     */
    public function find($id)
    {
	    $responseData = $this->request->post([
		    'queries' => [
			    [ 'class' => $this->entity, 'type' => 'data-list', 'id' => [$id] ]
		    ]
	    ]);

	    if(count($responseData->responses[0]) === 0)
	    {
		    return new $this->model($this->request);
	    }

        return new $this->model($this->request, $responseData->responses[0][0]);
    }

    public function first()
    {
	    $responseData = $this->request->post([
		    'queries' => [
			    [ 'class' => $this->entity, 'type' => 'data-list' ]
		    ]
	    ]);

        $fetchedItems = $responseData->responses[0];

        if(count($fetchedItems) === 0)
        {
        	return new $this->model($this->request);
        }

        return new $this->model($this->request, $fetchedItems[0]);
    }

    /**
     * @return \Illuminate\Support\Collection|Model[]
     */
    public function get()
    {
        $responseData = $this->request->post([
	        'queries' => [
		        [ 'class' => $this->entity, 'type' => 'data-list' ]
	        ]
        ]);

        $fetchedItems = $responseData->responses[0];

        dd($fetchedItems);

        $items = collect([]);
        foreach ($fetchedItems as $item) {
            /** @var Model $model */
            $model = new $this->model($this->request, $item);

            $items->push($model);
        }

        return $items;
    }

    public function create($data)
    {
        // todo
        $response = $this->request->curl->post("/{$this->entity}", [
            'json' => $data
        ]);

        $responseData = json_decode($response->getBody()->getContents());

        return new $this->model($this->request, $responseData);
    }
}

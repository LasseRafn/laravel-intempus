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
        $response = $this->request->curl->post('', [
            'query'       => [
                'pk' => $this->request->pk
            ],
            'form_params' => [
                'data' => json_encode([
                    'nonce'   => $this->request->nounce,
                    'token'   => $this->request->token,
                    'queries' => [
                        [ 'class' => $this->entity, 'type' => 'data', 'id' => [$id] ]
                    ]
                ])
            ],
        ]);

        // todo check for errors and such

        $responseData = json_decode($response->getBody()->getContents());

        $firstKey = key($responseData->responses[0]);

        return new $this->model($this->request, $responseData->responses[0]->{$firstKey});
    }

    public function first()
    {
        $response = $this->request->curl->post('', [
            'query'       => [
                'pk' => $this->request->pk
            ],
            'form_params' => [
                'data' => json_encode([
                    'nonce'   => $this->request->nounce,
                    'token'   => $this->request->token,
                    'queries' => [
                        [ 'class' => $this->entity, 'type' => 'data' ]
                    ]
                ])
            ],
        ]);

        // todo check for errors and such

        $responseData = json_decode($response->getBody()->getContents());
        $fetchedItems = $responseData->responses[0];

        $firstKey = key($fetchedItems);

        return new $this->model($this->request, $fetchedItems->{$firstKey});
    }

    /**
     * @return \Illuminate\Support\Collection|Model[]
     */
    public function get()
    {
        $response = $this->request->curl->post('', [
            'query'       => [
                'pk' => $this->request->pk
            ],
            'form_params' => [
                'data' => json_encode([
                    'nonce'   => $this->request->nounce,
                    'token'   => $this->request->token,
                    'queries' => [
                        [ 'class' => $this->entity, 'type' => 'data' ]
                    ]
                ])
            ],
        ]);

        // todo check for errors and such

        $responseData = json_decode($response->getBody()->getContents());
        $fetchedItems = $responseData->responses[0];

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

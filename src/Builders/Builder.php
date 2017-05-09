<?php

namespace LasseRafn\LaravelIntempus\Builders;

use LasseRafn\LaravelIntempus\Utils\Model;
use LasseRafn\LaravelIntempus\Utils\Request;

class Builder
{
	private   $request;
	protected $entity;

	/** @var Model */
	protected $model;

	public function __construct( Request $request )
	{
		$this->request = $request;
	}

	/**
	 * @param $id
	 *
	 * @return mixed|Model
	 */
	public function find( $id )
	{
		$responseData = $this->request->post( [
			'queries' => [
				[ 'class' => $this->entity, 'type' => 'data-list', 'id' => [ $id ] ],
			],
		] );

		if ( count( $responseData->responses[0] ) === 0 )
		{
			return false;
		}

		return new $this->model( $this->request, $responseData->responses[0][0] );
	}

	public function first()
	{
		$responseData = $this->request->post( [
			'queries' => [
				[ 'class' => $this->entity, 'type' => 'data-list' ],
			],
		] );

		$fetchedItems = $responseData->responses[0];

		if ( count( $fetchedItems ) === 0 )
		{
			return false;
		}

		return new $this->model( $this->request, $fetchedItems[0] );
	}

	/**
	 * @return \Illuminate\Support\Collection|Model[]
	 */
	public function get( $conditionKey = null, $conditionValue = null )
	{
		$query = [ 'class' => $this->entity, 'type' => 'data-list' ];

		if ( $conditionKey )
		{
			$query[ $conditionKey ] = $conditionValue;
		}

		$responseData = $this->request->post( [
			'queries' => [
				$query,
			],
		] );

		$fetchedItems = $responseData->responses[0];

		$items = collect( [] );
		foreach ( $fetchedItems as $item )
		{
			/** @var Model $model */
			$model = new $this->model( $this->request, $item );

			$items->push( $model );
		}

		return $items;
	}

	public function create( $data )
	{
		$response = $this->request->create( $data, $this->entity );

		return new $this->model( $this->request, $response );
	}
}

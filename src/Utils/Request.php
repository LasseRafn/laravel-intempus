<?php

namespace LasseRafn\LaravelIntempus\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Request
{
	public $curl;
	public $nonce;
	public $token;
	public $pk;

	public function __construct( $nonce = '', $token = '', $pk = '', $endpoint = '' )
	{
		$this->curl = new Client( [
			'base_uri' => $endpoint,
			'headers'  => [
				'Content-Type' => 'application/x-www-form-urlencoded',
			],
		] );

		$this->nonce = $nonce;
		$this->token = $token;
		$this->pk    = $pk;
	}

	public function post( $data )
	{
		$data['nonce'] = $this->nonce;
		$data['token'] = $this->token;

		try
		{
			$response = $this->curl->post( '', [
				'query'       => [
					'pk' => $this->pk,
				],
				'form_params' => [
					'data' => json_encode( $data ),
				],
			] );
		} catch ( ClientException $exception )
		{
			if ( $exception->hasResponse() )
			{
				throw new \Exception( $exception->getResponse()->getBody()->getContents() );
			}

			throw $exception;
		}

		return json_decode( $response->getBody()->getContents() );
	}

	public function create( $data, $entity )
	{
		try
		{
			$response = $this->curl->post( '', [
				'query'       => [
					'pk' => $this->pk,
				],
				'form_params' => [
					'data' => json_encode( [
						'nonce'  => $this->nonce,
						'token'  => $this->token,
						'create' => (object) [
							$entity => [ (object) $data ]
						]
					] )
				],
			] );
		} catch ( ClientException $exception )
		{
			if ( $exception->hasResponse() )
			{
				throw new \Exception( $exception->getResponse()->getBody()->getContents() );
			}

			throw $exception;
		}

		return json_decode( $response->getBody()->getContents() );
	}

	public function update( $entity, $primaryKey, $data )
	{
		try
		{
			$response = $this->curl->post( '', [
				'query'       => [
					'pk' => $this->pk,
				],
				'form_params' => [
					'data' => json_encode([
						'nonce'  => $this->nonce,
						'token'  => $this->token,
						'update' => [
							$entity => (object) [
								$primaryKey => (object) [
									'update' => (object) $data
								]
							]
						],
					])
				],
			] );
		} catch ( ClientException $exception )
		{
			if ( $exception->hasResponse() )
			{
				throw new \Exception( $exception->getResponse()->getBody()->getContents() );
			}

			throw $exception;
		}

		return json_decode( $response->getBody()->getContents() );
	}
}

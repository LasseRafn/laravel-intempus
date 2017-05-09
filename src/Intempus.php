<?php

namespace LasseRafn\LaravelIntempus;

use LasseRafn\LaravelIntempus\Utils\Request;
use LasseRafn\LaravelIntempus\Builders\CaseBuilder;
use LasseRafn\LaravelIntempus\Builders\ProductBuilder;
use LasseRafn\LaravelIntempus\Builders\ContractBuilder;
use LasseRafn\LaravelIntempus\Builders\CustomerBuilder;
use LasseRafn\LaravelIntempus\Builders\EmployeeBuilder;
use LasseRafn\LaravelIntempus\Builders\WorkTypeBuilder;
use LasseRafn\LaravelIntempus\Builders\CaseGroupBuilder;
use LasseRafn\LaravelIntempus\Builders\WorkModelBuilder;
use LasseRafn\LaravelIntempus\Builders\WorkReportBuilder;
use LasseRafn\LaravelIntempus\Builders\WorkCategoryBuilder;
use LasseRafn\LaravelIntempus\Builders\CustomerGroupBuilder;
use LasseRafn\LaravelIntempus\Builders\EmployeeCaseRuleBuilder;

class Intempus
{
	protected $request;
	protected $nounce;
	protected $pk;
	protected $token;

	public function __construct( $nounce = '', $token = '', $pk = '' )
	{
		$this->pk     = $pk;
		$this->nounce = $nounce;
		$this->token  = $token;

		$this->request = new Request( $nounce, $token, $pk, $this->getEndpoint() . config( 'intempus.exchange_endpoint' ) );
	}

	private function getEndpoint()
	{
		return config( 'intempus.test_mode' ) ? config( 'intempus.test_request_endpoint' ) : config( 'intempus.request_endpoint' );
	}

	public function getAuth( $nonce = '' )
	{
		$url = $this->getEndpoint() . config( 'intempus.auth_endpoint' );

		if ( empty( $nonce ) || $nonce === '' )
		{
			$nonce = str_random( 65 );
		}

		$hash = hash( 'sha384', $nonce );

		$domain = config( 'intempus.domain' );

		if ( ! $domain )
		{
			$domain = env( 'APP_URL' );
		}

		$domain = preg_replace( '/http(s?)\:\/\//', '', $domain );

		$url = str_replace( ':domain', $domain, $url );
		$url = str_replace( ':hash', $hash, $url );

		$this->request->nounce = $nonce;

		return [
			'url'   => $url,
			'hash'  => $hash,
			'nonce' => $nonce,
		];
	}

	public function workModels()
	{
		return new WorkModelBuilder( $this->request );
	}

	public function cases()
	{
		return new CaseBuilder( $this->request );
	}

	public function caseGroups()
	{
		return new CaseGroupBuilder( $this->request );
	}

	public function contracts()
	{
		return new ContractBuilder( $this->request );
	}

	public function customers()
	{
		return new CustomerBuilder( $this->request );
	}

	public function customerGroups()
	{
		return new CustomerGroupBuilder( $this->request );
	}

	public function employees()
	{
		return new EmployeeBuilder( $this->request );
	}

	public function employeeCaseRules()
	{
		return new EmployeeCaseRuleBuilder( $this->request );
	}

	public function products()
	{
		return new ProductBuilder( $this->request );
	}

	public function workCategories()
	{
		return new WorkCategoryBuilder( $this->request );
	}

	public function workReports()
	{
		return new WorkReportBuilder( $this->request );
	}

	public function workTypes()
	{
		return new WorkTypeBuilder( $this->request );
	}

	public function batchHandle( array $createData = [], array $updateData = [] )
	{
		try
		{
			$formData = [];

			$formData['nonce'] = $this->nounce;
			$formData['token'] = $this->token;

			if ( count( $createData ) )
			{
				$formData['create'] = $createData;
			}

			if ( count( $updateData ) )
			{
				$formData['update'] = $updateData;
			}

			$response = $this->request->curl->post( '', [
				'query'       => [
					'pk' => $this->pk,
				],
				'form_params' => [
					'data' => json_encode( $formData )
				]
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

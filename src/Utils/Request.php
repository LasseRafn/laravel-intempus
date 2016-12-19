<?php
namespace LasseRafn\LaravelIntempus\Utils;

use GuzzleHttp\Client;

class Request
{
    public $curl;
    public $nounce;
    public $token;
    public $pk;

    public function __construct($nounce = '', $token = '', $pk = '', $endpoint = '')
    {
        $this->curl = new Client([
            'base_uri' => $endpoint,
            'headers'  => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);

        $this->nounce = $nounce;
        $this->token  = $token;
        $this->pk  = $pk;
    }
}

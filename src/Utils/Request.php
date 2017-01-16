<?php

namespace LasseRafn\LaravelIntempus\Utils;

use GuzzleHttp\Client;

class Request
{
    public $curl;
    public $nonce;
    public $token;
    public $pk;

    public function __construct($nonce = '', $token = '', $pk = '', $endpoint = '')
    {
        $this->curl = new Client([
            'base_uri' => $endpoint,
            'headers'  => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);

        $this->nonce = $nonce;
        $this->token = $token;
        $this->pk = $pk;
    }

    public function post($data)
    {
        $data['nonce'] = $this->nonce;
        $data['token'] = $this->token;

        $response = $this->curl->post('', [
            'query'       => [
                'pk' => $this->pk,
            ],
            'form_params' => [
                'data' => json_encode($data),
            ],
        ]);

        // todo check for errors and such

        return json_decode($response->getBody()->getContents());
    }
}

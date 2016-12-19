<?php namespace LasseRafn\LaravelIntempus;

use LasseRafn\LaravelIntempus\Builders\CaseBuilder;
use LasseRafn\LaravelIntempus\Builders\WorkModelBuilder;
use LasseRafn\LaravelIntempus\Utils\Request;

class Intempus
{
    protected $request;

    public function __construct($nounce = '', $token = '', $pk = '')
    {
        $this->request = new Request($nounce, $token, $pk, $this->getEndpoint() . config('intempus.exchange_endpoint'));
    }

    private function getEndpoint()
    {
        return config('intempus.test_mode') ? config('intempus.test_request_endpoint') : config('intempus.request_endpoint');
    }

    public function getAuth($nonce = '')
    {
        $url = $this->getEndpoint() . config('intempus.auth_endpoint');

        if (empty($nonce) || $nonce === '') {
            $nonce = str_random(65);
        }

        $hash = hash('sha384', $nonce);

        $domain = config('intempus.domain');

        if (! $domain) {
            $domain = env('APP_URL');
        }

        $domain = preg_replace('/http(?s)\:\/\//', '', $domain);

        $url = str_replace(':domain', $domain, $url);
        $url = str_replace(':hash', $hash, $url);

        $this->request->nounce = $nonce;

        return [
            'url'  => $url,
            'hash' => $hash,
            'nonce' => $nonce,
        ];
    }

    public function workModels()
    {
        return new WorkModelBuilder($this->request);
    }

    public function cases()
    {
        return new CaseBuilder($this->request);
    }
}

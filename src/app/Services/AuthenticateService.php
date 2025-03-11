<?php

namespace Paiva\address\app\Services;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use PSpell\Config;

class AuthenticateService
{
    private string $accessToken;
    private string $baseUri;
    private string $grantType;
    private string $clientSecret;
    private string $clientId;


    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->authenticate();
        $this->baseUri = Config::get('address.server.uri');
        $this->grantType = Config::get('address.server.grant_type');
        $this->clientId = Config::get('address.server.client_id');
        $this->clientSecret = Config::get('address.server.client_secret');
    }

    /**
     * @throws ConnectionException
     * @throws Exception
     */
    private function authenticate(): void
    {
        $response = Http::asForm()->post("{$this->baseUri}/oauth/token", [
            'grant_type'    => $this->grantType,
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);

        if ($response->successful()) {
            $this->accessToken = $response->json()['access_token'];
        } else {
            throw new Exception('Falha na autenticação: ' . $response->body());
        }
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}

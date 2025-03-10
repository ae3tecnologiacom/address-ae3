<?php

namespace Paiva\address\app\Services;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class AuthenticateService
{
    private string $accessToken;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->authenticate();
    }

    /**
     * @throws ConnectionException
     * @throws Exception
     */
    private function authenticate(): void
    {
        $response = Http::asForm()->post("http://host.docker.internal:8090/oauth/token", [
            'grant_type'    => 'client_credentials',
            'client_id'     => '2',
            'client_secret' => 'OrVHpkNacUBXRF2TDSWoMHNHpPRrKLE5Qwrx7oDl',
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

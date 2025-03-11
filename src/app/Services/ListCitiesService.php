<?php

namespace Paiva\address\app\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class ListCitiesService
{
    private string $accessToken;
    private string $baseUri;

    public function __construct(private readonly AuthenticateService $authenticateService)
    {
        $this->accessToken = $this->authenticateService->getAccessToken();
        $this->baseUri = Config::get('address.server.uri');
    }

    /**
     * @return mixed|string
     */
    public function listCities(): mixed
    {
        try {
            $response = Http::withToken($this->accessToken)
                ->get("{$this->baseUri}/api/v1/address/cities");

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function ListCitiesByStates(string $uf)
    {
        try {
            $response = Http::withToken($this->accessToken)
                ->get("{$this->baseUri}/api/v1/address/states/{$uf}/cities");

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}

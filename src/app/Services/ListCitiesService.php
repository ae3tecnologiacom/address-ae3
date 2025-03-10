<?php

namespace Paiva\address\app\Services;

use Illuminate\Support\Facades\Http;

class ListCitiesService
{
    private string $accessToken;

    public function __construct(private readonly AuthenticateService $authenticateService)
    {
        $this->accessToken = $this->authenticateService->getAccessToken();
    }

    /**
     * @return mixed|string
     */
    public function listCities(): mixed
    {
        try {
            $response = Http::withToken($this->accessToken)
                ->get("http://host.docker.internal:8090/api/v1/address/cities");

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function ListCitiesByStates(string $uf)
    {
        try {
            $response = Http::withToken($this->accessToken)
                ->get("http://host.docker.internal:8090/api/v1/address/states/{$uf}/cities");

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

}

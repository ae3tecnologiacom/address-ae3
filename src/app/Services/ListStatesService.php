<?php

namespace Paiva\address\app\Services;

use Illuminate\Support\Facades\Http;

class ListStatesService
{
    private string $accessToken;

    public function __construct(private readonly AuthenticateService $authenticateService)
    {
        $this->accessToken = $this->authenticateService->getAccessToken();
    }

    public function listStates()
    {

        try {
            $response = Http::withToken($this->accessToken)
                ->get("http://host.docker.internal:8090/api/v1/address/states");

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function listStatesByCountry(int $country_id)
    {
        try {
            $response = Http::withToken($this->accessToken)
                ->get("http://host.docker.internal:8090/api/v1/address/countries/22/states");

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}

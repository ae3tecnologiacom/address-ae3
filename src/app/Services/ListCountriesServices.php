<?php

namespace Paiva\address\app\Services;

use Illuminate\Support\Facades\Http;

class ListCountriesServices
{

    private string $accessToken;

    public function __construct(private readonly AuthenticateService $authenticateService)
    {
        $this->accessToken = $this->authenticateService->getAccessToken();
    }
    public function listCountries()
    {
        try {
            $response = Http::withToken($this->accessToken)
                ->get("http://host.docker.internal:8090/api/v1/address/countries");

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}

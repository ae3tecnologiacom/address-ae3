<?php

namespace Paiva\address\app\Services;

use Illuminate\Support\Facades\Http;

class ListStatesService
{
    private string $accessToken;
    private string $baseUri;


    public function __construct(private readonly AuthenticateService $authenticateService)
    {
        $this->accessToken = $this->authenticateService->getAccessToken();
        $this->baseUri = Config::get('address.server.uri');

    }

    public function listStates()
    {

        try {
            $response = Http::withToken($this->accessToken)
                ->get("{$this->baseUri}/api/v1/address/states");

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function listStatesByCountry(int $country_id)
    {
        try {
            $response = Http::withToken($this->accessToken)
                ->get("{$this->baseUri}/api/v1/address/countries/22/states");

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}

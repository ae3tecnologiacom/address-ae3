<?php

namespace Paiva\address\app\Services;

use Illuminate\Support\Facades\Http;

class SearchAddressService
{
    private string $accessToken;

    public function __construct(private readonly AuthenticateService $authenticateService)
    {
        $this->accessToken = $this->authenticateService->getAccessToken();
    }

    public function searchAddress($data)
    {
        try {
            $response = Http::withToken($this->accessToken)
                ->get("http://host.docker.internal:8090/api/v1/address/zipcodes/addresses", [
                    'q' => $data->q,
                    'scope' => $data->scope,
                ]);


            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}

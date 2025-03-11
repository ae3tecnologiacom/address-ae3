<?php

namespace Paiva\address\app\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class SearchAddressService
{
    private string $accessToken;
    private string $baseUri;


    public function __construct(private readonly AuthenticateService $authenticateService)
    {
        $this->accessToken = $this->authenticateService->getAccessToken();
        $this->baseUri = Config::get('address.server.uri');
    }

    public function searchAddress($data)
    {
        try {
            $response = Http::withToken($this->accessToken)
                ->get("{$this->baseUri}/api/v1/address/zipcodes/addresses", [
                    'q' => $data->q,
                    'scope' => $data->scope,
                ]);


            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}

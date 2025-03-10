<?php

namespace Paiva\address\app\Services;

use Illuminate\Support\Facades\Http;

class ListNeighborhoodsService
{
    private string $accessToken;

    public function __construct(private readonly AuthenticateService $authenticateService)
    {
        $this->accessToken = $this->authenticateService->getAccessToken();
    }

    /**
     * @return mixed|string
     */
    public function listNeighborhoods(): mixed
    {
        try {
            $response = Http::withToken($this->accessToken)
                ->get("http://host.docker.internal:8090/api/v1/address/neighborhoods");

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function listNeighborhoodsByCity(int $city_id)
    {
        try {
            $response = Http::withToken($this->accessToken)
                ->get("http://host.docker.internal:8090/api/v1/address/neighborhoods/{$city_id}");

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}

<?php

namespace App\Providers\IpInfo;

use Illuminate\Support\Facades\Http;
use App\Contracts\BaseIpInfoProvider;

class IpInfoIoProvider extends BaseIpInfoProvider
{
    protected $apiUrl = 'https://ipinfo.io/%s/json';

    protected function fetchIpInfo(?string $ip = null): array
    {
        try {
            $response = Http::get(sprintf($this->apiUrl, $ip));

            if ($response->successful() && $location = $response->collect('loc')) {
                [$lat, $lng] = explode(',', $location->first());

                return [...$response->json(), ...['lat' => $lat, 'lng' => $lng]];
            }
        } catch (\Exception) {
        }

        return [];
    }
}

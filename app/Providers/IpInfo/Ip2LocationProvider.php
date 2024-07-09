<?php

namespace App\Providers\IpInfo;

use Illuminate\Support\Facades\Http;
use App\Contracts\BaseIpInfoProvider;

class Ip2LocationProvider extends BaseIpInfoProvider
{
    protected $apiUrl = 'https://api.ip2location.io/?ip=%s';

    protected function fetchIpInfo(?string $ip = null): array
    {
        try {
            $response = Http::get(sprintf($this->apiUrl, $ip));

            return $response->successful() ? $response->json() : [];
        } catch (\Exception) {
        }

        return [];
    }
}

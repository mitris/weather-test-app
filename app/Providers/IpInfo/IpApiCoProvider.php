<?php

namespace App\Providers\IpInfo;

use Illuminate\Support\Facades\Http;
use App\Contracts\BaseIpInfoProvider;

class IpApiCoProvider extends BaseIpInfoProvider
{
    protected $apiUrl = 'https://ipapi.co/%s/json';

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

<?php

namespace App\Providers\IpInfo;

use Illuminate\Support\Facades\Http;
use App\Contracts\BaseIpInfoProvider;

class IpApiIsProvider extends BaseIpInfoProvider
{
    protected $apiUrl = 'https://api.ipapi.is/?q=%s';

    protected function fetchIpInfo(?string $ip = null): array
    {
        try {
            $response = Http::get(sprintf($this->apiUrl, $ip));

            return $response->successful() ? $response->collect('location')->toArray() : [];
        } catch (\Exception) {
        }

        return [];
    }
}

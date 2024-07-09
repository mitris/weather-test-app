<?php

namespace App\Services;

use App\Contracts\IpInfoProviderInterface;

/**
 * Service class for retrieving IP information using a provider.
 */
class IpInfoService
{
    /**
     * @var IpInfoProviderInterface The IP information provider.
     */
    protected $provider;

    /**
     * Constructor.
     *
     * @param IpInfoProviderInterface $provider The IP information provider.
     */
    public function __construct(IpInfoProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Get IP information.
     *
     * @param string|null $ip The IP address.
     * @return array The IP information.
     */
    public function getIpInfo(?string $ip = null): array
    {
        return $this->provider->getIpInfo($ip);
    }

    /**
     * Get latitude.
     *
     * @param string|null $ip The IP address.
     * @return float|null The latitude.
     */
    public function getLatitude(?string $ip = null): ?float
    {
        return $this->provider->getLatitude($ip);
    }

    /**
     * Get longitude.
     *
     * @param string|null $ip The IP address.
     * @return float|null The longitude.
     */
    public function getLongitude(?string $ip = null): ?float
    {
        return $this->provider->getLongitude($ip);
    }

    /**
     * Get latitude and longitude as an array.
     *
     * @param string|null $ip The IP address.
     * @return array|null The latitude and longitude as an array.
     */
    public function getLatLng(?string $ip = null): ?array
    {
        return $this->provider->getLatLng($ip);
    }

    /**
     * Get latitude and longitude as an array.
     *
     * @param string|null $ip The IP address.
     * @return array|null The latitude and longitude as an array.
     */
    public function getLatitudeLongitude(?string $ip = null): ?array
    {
        return $this->provider->getLatitudeLongitude($ip);
    }

    /**
     * Get city.
     *
     * @param string|null $ip The IP address.
     * @return string|null The city.
     */
    public function getCity(?string $ip = null): ?string
    {
        return $this->provider->getCity($ip);
    }

    /**
     * Get country.
     *
     * @param string|null $ip The IP address.
     * @return string|null The country.
     */
    public function getCountry(?string $ip = null): ?string
    {
        return $this->provider->getCountry($ip);
    }

    /**
     * Get country code.
     *
     * @param string|null $ip The IP address.
     * @return string|null The country code.
     */
    public function getCountryCode(?string $ip = null): ?string
    {
        return $this->provider->getCountryCode($ip);
    }
}

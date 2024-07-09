<?php

namespace App\Contracts;

use InvalidArgumentException;
use Illuminate\Support\Facades\Cache;

abstract class BaseIpInfoProvider implements IpInfoProviderInterface
{
    protected $ip = null;

    protected $responseCache = [];

    public function __construct(?string $ip = null)
    {
        $this->ip = $ip ?? request()->ip();
    }

    /**
     * Set the IP address for which the information will be fetched.
     *
     * @param string $ip The IP address to set.
     *
     * @return self The current instance of the class for method chaining.
     *
     * @throws \InvalidArgumentException If the provided IP address is not a valid.
     */
    public function setIp(string $ip): self
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new InvalidArgumentException('The provided IP address not valid.');
        }

        $this->ip = $ip;

        $this->fetchIpInfo();

        return $this;
    }

    /**
     * Get the IP address for which the information will be fetched.
     *
     * @return string The IP address.
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * Get the country of the IP address.
     *
     * @return string|null The country of the IP address.
     */
    public function getCountry(): ?string
    {
        return $this->getIpInfo('country');
    }

    /**
     * Get the country code of the IP address.
     *
     * @return string|null The country code of the IP address.
     */
    public function getCountryCode(): ?string
    {
        return $this->getIpInfo('countryCode');
    }

    /**
     * Get the city of the IP address.
     *
     * @return string|null The city of the IP address.
     */
    public function getCity(): ?string
    {
        return $this->getIpInfo('city');
    }

    /**
     * Get the IP information.
     *
     * @param string|null $ip The IP address for which to fetch the information. If null, it will use the IP address from the request.
     *
     * @return mixed The IP information.
     */
    public function getIpInfo(?string $attr = null, ?string $ip = null): mixed
    {
        // Set the IP address to use
        $this->ip = $ip ?? config('services.ip_info.localhost_debug') ?? $this->request->ip();

        // If caching is enabled, check if the data is in cache
        if (config('services.ip_info.cache')) {
            // Generate the cache key
            $cacheKey = config('services.ip_info.cache_prefix') . $this->ip;

            // Fetch and cache the data if not in cache
            $cached = Cache::remember(
                $cacheKey,
                config('services.ip_info.cache'),
                fn () => $this->getCachedResponse()
            );
        } else {
            // If caching is disabled, fetch the data directly
            $cached = $this->getCachedResponse();
        }

        // Return the requested attribute if provided, otherwise return the entire cached data
        return $attr ? $cached[$attr] ?? null : $cached;
    }

    /**
     * Get the cached response for the current IP address.
     *
     * This method checks if the IP address data is already cached. If it is, it returns the cached data.
     * If it is not, it fetches the data using the fetchIpInfo method and caches it before returning it.
     *
     * @return array The cached IP information response.
     */
    protected function getCachedResponse()
    {
        // Use null coalescing assignment operator to check if the data is in cache
        // If not, fetch the data using the fetchIpInfo method and cache it
        return $this->responseCache[$this->ip] ??= $this->modifyKeys($this->fetchIpInfo($this->ip));
    }

    /**
     * Modify the keys of the IP information response to match the desired format.
     *
     * @param array $response The IP information response.
     *
     * @return array The modified IP information response.
     */
    protected function modifyKeys(array $response): array
    {
        // Use Laravel's collection to map and transform the keys
        return collect($response)->mapWithKeys(
            // Use a match expression to map the keys
            fn ($value, $key) => [match ($key) {
                'lat' => 'latitude',
                'lon', 'lng' => 'longitude',
                'country_code' => 'countryCode',
                default => $key,
            }
            => $value]
        )->toArray();
    }

    /**
     * Abstract method to fetch IP information.
     *
     * This method should be implemented by each concrete class that extends BaseIpInfoProvider.
     * It should make the necessary API calls or database queries to fetch the IP information.
     *
     * @return array The fetched IP information.
     */
    abstract protected function fetchIpInfo(?string $ip = null): array;

    /**
     * Get the latitude of the IP address.
     *
     * This method fetches the IP information using the getIpInfo method and returns the latitude.
     * If the latitude is not available in the response, it returns null.
     *
     * @return float|null The latitude of the IP address.
     */
    public function getLatitude(): ?float
    {
        return $this->getIpInfo('latitude');
    }

    /**
     * Get the longitude of the IP address.
     *
     * This method fetches the IP information using the getIpInfo method and returns the longitude.
     * If the longitude is not available in the response, it returns null.
     *
     * @return float|null The longitude of the IP address.
     */
    public function getLongitude(): ?float
    {
        // Fetch the IP information
        return  $this->getIpInfo('longitude');
    }

    /**
     * Get the latitude and longitude of the IP address as an array.
     *
     * This method fetches the latitude and longitude of the IP address using the getLatitude() and getLongitude() methods.
     * It returns an array containing the latitude and longitude. If either the latitude or longitude is not available,
     * it returns null for that specific value.
     *
     * @return array|null An array containing the latitude and longitude of the IP address.
     *                    The array has the following structure: ['latitude' => float|null, 'longitude' => float|null].
     */
    public function getLatLng(): array
    {
        return [
            $this->getLatitude(),
            $this->getLongitude()
        ];
    }

    /**
     * Get the latitude and longitude of the IP address as an associative array.
     *
     * This method fetches the latitude and longitude of the IP address using the getLatitude() and getLongitude() methods.
     * It returns an associative array containing the latitude and longitude. If either the latitude or longitude is not available,
     * it returns null for that specific value.
     *
     * @return array|null An associative array containing the latitude and longitude of the IP address.
     *                    The array has the following structure: ['latitude' => float|null, 'longitude' => float|null].
     */
    public function getLatitudeLongitude(): array
    {
        return [
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
        ];
    }

    /**
     * Generate a unique fingerprint for the user based on their IP addresses and user agent.
     *
     * @return string The MD5 hash of the concatenated IP addresses and user agent.
     */
    public function userFingerprint(): string
    {
        return md5(implode(',', [
            implode(request()->ips()), // Concatenate all IP addresses
            request()->userAgent(), // Fetch the user agent
        ]));
    }
}

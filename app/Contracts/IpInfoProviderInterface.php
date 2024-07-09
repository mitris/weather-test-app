<?php

namespace App\Contracts;

use Illuminate\Http\Request;

/**
 * Interface IpInfoProviderInterface
 *
 * @package App\Contracts
 */
interface IpInfoProviderInterface
{

    /**
     * Returns the IP address.
     *
     * @return string
     */
    public function getIp(): string;

    /**
     * Retrieves IP information as an associative array.
     *
     * @param string|null $ip
     * @return mixed
     */
    public function getIpInfo(?string $ip = null): mixed;

    /**
     * Returns the latitude of the IP address.
     *
     * @return float|null
     */
    public function getLatitude(): ?float;

    /**
     * Returns the longitude of the IP address.
     *
     * @return float|null
     */
    public function getLongitude(): ?float;

    /**
     * Returns the country name of the IP address.
     *
     * @return string|null
     */
    public function getCountry(): ?string;

    /**
     * Returns the country code of the IP address.
     *
     * @return string|null
     */
    public function getCountryCode(): ?string;

    /**
     * Returns the city name of the IP address.
     *
     * @return string|null
     */
    public function getCity(): ?string;

    /**
     * Returns the latitude and longitude as an associative array.
     *
     * @return array
     */
    public function getLatLng(): array;

    /**
     * Returns the latitude and longitude as an associative array.
     *
     * @return array
     */
    public function getLatitudeLongitude(): array;

    /**
     * Returns a unique user fingerprint based on the IP address.
     *
     * @return string
     */
    public function userFingerprint(): string;
}

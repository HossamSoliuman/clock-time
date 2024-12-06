<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class PrayerTimeService
{
    protected $client;
    protected $apiUrl = "https://api.aladhan.com/v1/timingsByCity";

    public function __construct()
    {
        // Initialize the Guzzle HTTP client
        $this->client = new Client();
    }

    /**
     * Get prayer timings for a given date, city, and country.
     *
     * @param string $date
     * @param string $city
     * @param string $country
     * @return array|null
     */
    public function getPrayerTimings($date, $city, $country)
    {
        try {
            // Make a GET request to fetch prayer timings
            $response = $this->client->get($this->apiUrl, [
                'query' => [
                    'date' => $date,
                    'city' => $city,
                    'country' => $country
                ],
                'verify' => false // Adjust according to your needs
            ]);

            $statusCode = $response->getStatusCode();
            Log::info("Prayer Timings API response status: " . $statusCode);

            if ($statusCode === 200) {
                return json_decode($response->getBody(), true);
            } else {
                Log::error("Failed to get prayer timings. Status code: " . $statusCode);
                Log::error("Response body: " . $response->getBody());
                return null;
            }
        } catch (RequestException $e) {
            Log::error("Error fetching prayer timings: " . $e->getMessage());
            return null;
        } catch (GuzzleException $e) {
            Log::error("Guzzle error fetching prayer timings: " . $e->getMessage());
            return null;
        }
    }
}

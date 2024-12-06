<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class TimeApiService
{
    protected $client;
    protected $varify;
    protected $healthUrl = "http://timeapi.io/api/health/check";
    protected $timeUrl = "http://timeapi.io/api/time/current/zone";
    protected $timeUrlLat = "https://timeapi.io/api/time/current/coordinate";

    public function __construct($varify = false)
    {
        // Initialize the Guzzle HTTP client
        $this->client = new Client();
       $this->varify = $varify;
    }

    /**
     * Check the health of the API using Guzzle.
     *
     * @return bool
     */
    public function checkHealth()
    {
        try {
            $response = $this->client->get($this->healthUrl,[
                'verify' => false


            ]);
           $statusCode = $response->getStatusCode() ;

            if ($statusCode == 200) {

                return true;
            } else {
               Log::error("Failed to check health. Status code: " . $statusCode);
                return false;
            }
        } catch (RequestException $e) {
           Log::error("API Health Check Failed: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get the current time for a given time zone using Guzzle.
     *
     * @param string $timeZone
     * @return array|null
     */
    public function getCurrentTime($timeZone)
    {
        if ($this->checkHealth()) {
            try {
                // Make a GET request to fetch the current time
                $response = $this->client->get($this->timeUrl, [
                    'query' => ['timeZone' => $timeZone],
                    'verify' => $this->varify

                ]);

                $statusCode = $response->getStatusCode();
               Log::info("Time API response status: " . $statusCode);

                if ($statusCode === 200) {
                    return json_decode($response->getBody(), true);
                } else {
                   Log::error("Failed to get current time. Status code: " . $statusCode);
                   Log::error("Response body: " . $response->getBody());
                    return null;
                }
            } catch (RequestException $e) {
               Log::error("Error fetching current time: " . $e->getMessage());
                return null;
            }
        } else {
           Log::error("API is not healthy.");
            return null;
        }
    }
    public function getTimeLatAndLon($lat,$lng)
    {
//        if ($this->checkHealth()) {
            try {
                // Make a GET request to fetch the current time
                $response = $this->client->get($this->timeUrlLat, [

                    'query' => [
                        'latitude' => $lat,
                        'longitude' => $lng,
                ],
                    'verify' => $this->varify,
                    'timeout' => 30, // Adjust timeout as needed

                ]);

                $statusCode = $response->getStatusCode();
               Log::info("Time API response status: " . $statusCode);

                if ($statusCode === 200) {
                    return json_decode($response->getBody(), true);
                } else {
                   Log::error("Failed to get current time. Status code: " . $statusCode);
                   Log::error("Response body: " . $response->getBody());
                    return null;
                }
            } catch (RequestException $e) {
               Log::error("Error fetching current time: " . $e->getMessage());
                return null;
            }
                catch (GuzzleException $e) {
            Log::error("Guzzle error fetching current time: " . $e->getMessage());
            return null;
            }
//        } else {
//           Log::error("API is not healthy.");
//            return null;
//        }
    }
}

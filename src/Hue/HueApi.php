<?php

namespace PhpTrafficLight\Hue;

use GuzzleHttp\Client;
use PhpTrafficLight\Interfaces\TrafficLightApiInterface;

class HueApi implements TrafficLightApiInterface
{
    /**
     * @const string
     */
    const BRIDGE_IP = '192.168.231.148';

    /**
     * @const string
     */
    const BRIDGE_USER = 'WXxABEgt10-qa2XcYZrdIH1OYnQp2HjwupjK77nX';

    /**
     * @var Client
     */
    private $client;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://' . self::BRIDGE_IP . '/api/' . self::BRIDGE_USER . '/'
        ]);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function activateLight(string $id): bool
    {
        $this->client->put("lights/{$id}/state", [
            'json' => [
                'on' => true,
                'transitiontime' => 0,
                'bri' => 254
            ]
        ]);

        return true;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function deactivateLight(string $id): bool
    {
        $this->client->put("lights/{$id}/state", [
            'json' => [
                'on' => false,
                'transitiontime' => 0
            ]
        ]);

        return true;
    }
}

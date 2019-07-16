<?php

namespace PhpTrafficLight\Hue;

use PhpTrafficLight\Interfaces\TrafficLightApiInterface;
use Phue\Client;
use Phue\Command\GetLightById;
use Phue\Light;

class HueApi implements TrafficLightApiInterface
{
    /**
     * @var HueCredentials
     */
    private $credentials;

    /**
     * @var Client
     */
    private $client;

    /**
     * @param HueCredentials $credentials
     * @return void
     */
    public function __construct(HueCredentials $credentials)
    {
        $this->credentials = $credentials;
        $this->client = new Client($this->credentials->getBridgeIp(), $this->credentials->getBridgeUser());
    }

    /**
     * @param string $id
     * @return bool
     */
    public function activateLight(string $id): bool
    {
        /** @var Light $light */
        $light = $this->client->sendCommand(new GetLightById($id));
        $light->setOn(true);
        $light->setBrightness(255);
        return true;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function deactivateLight(string $id): bool
    {
        /** @var Light $light */
        $light = $this->client->sendCommand(new GetLightById($id));
        $light->setOn(false);
        return true;
    }
}

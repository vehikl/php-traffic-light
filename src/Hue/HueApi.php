<?php

namespace PhpTrafficLight\Hue;

use PhpTrafficLight\Interfaces\TrafficLightApiInterface;

class HueApi implements TrafficLightApiInterface
{
    /**
     * @var HueCredentials
     */
    private $credentials;

    /**
     * @param HueCredentials $credentials
     * @return void
     */
    public function __construct(HueCredentials $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function activateLight(string $id): bool
    {
        echo "Light '{$id}' is ON.\n";
        return true;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function deactivateLight(string $id): bool
    {
        echo "Light '{$id}' is OFF.\n";
        return true;
    }
}

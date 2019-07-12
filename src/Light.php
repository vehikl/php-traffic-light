<?php

namespace PhpTrafficLight;

use PhpTrafficLight\Interfaces\LightInterface;
use PhpTrafficLight\Interfaces\TrafficLightApiInterface;

class Light implements LightInterface
{
    /**
     * @var TrafficLightApiInterface
     */
    private $api;

    /**
     * @var string
     */
    private $id;

    /**
     * @param string $id
     * @param TrafficLightApiInterface $api
     * @return void
     */
    public function __construct(string $id, TrafficLightApiInterface $api)
    {
        $this->id = $id;
        $this->api = $api;
    }

    /**
     * @return bool
     */
    public function deactivate(): bool
    {
        $this->api->deactivateLight($this->id);
        return true;
    }

    /**
     * @return bool
     */
    public function activate(): bool
    {
        $this->api->activateLight($this->id);
        return true;
    }
}

<?php

namespace PhpTrafficLight;

use PhpTrafficLight\Interfaces\TrafficLightApiInterface;

class Light
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
     * @return void
     */
    public function deactivate(): void
    {
        $this->api->deactivateLight($this->id);
    }

    /**
     * @return void
     */
    public function activate(): void
    {
        $this->api->activateLight($this->id);
    }
}

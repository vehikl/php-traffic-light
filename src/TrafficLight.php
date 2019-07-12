<?php

namespace PhpTrafficLight;

use PhpTrafficLight\Interfaces\LightInterface;

class TrafficLight
{
    /**
     * @var Light
     */
    private $redLight;

    /**
     * @var Light
     */
    private $yellowLight;

    /**
     * @var Light
     */
    private $greenLight;

    /**
     * @param LightInterface $redLight
     * @param LightInterface $yellowLight
     * @param LightInterface $greenLight
     * @return void
     */
    public function __construct(LightInterface $redLight, LightInterface $yellowLight, LightInterface $greenLight)
    {
        $this->redLight = $redLight;
        $this->yellowLight = $yellowLight;
        $this->greenLight = $greenLight;
    }

    /**
     * @return void
     */
    public function testsAreRunning(): void
    {
        $this->redLight->deactivate();
        $this->greenLight->deactivate();
        $this->yellowLight->activate();
    }

    /**
     * @return void
     */
    public function testsFailed(): void
    {
        $this->yellowLight->deactivate();
        $this->greenLight->deactivate();
        $this->redLight->activate();
    }

    /**
     * @return void
     */
    public function testsPassed(): void
    {
        $this->yellowLight->deactivate();
        $this->redLight->deactivate();
        $this->greenLight->activate();
    }
}

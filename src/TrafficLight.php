<?php

namespace PhpTrafficLight;

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
     * @param Light $redLight
     * @param Light $yellowLight
     * @param Light $greenLight
     * @return void
     */
    public function __construct(Light $redLight, Light $yellowLight, Light $greenLight)
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

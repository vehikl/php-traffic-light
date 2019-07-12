<?php

namespace PhpTrafficLight\Tests\Unit;

use PhpTrafficLight\Tests\Fakes\Light;
use PhpTrafficLight\Tests\TestCase;
use PhpTrafficLight\TrafficLight;

final class TrafficLightTest extends TestCase
{
    /**
     * @return void
     */
    public function testItCanBeInstantiatedWithThreeLightInterfaces(): void
    {
        $this->assertInstanceOf(
            TrafficLight::class,
            new TrafficLight(new Light, new Light, new Light)
        );
    }

    /**
     * @return void
     */
    public function testItActivatesOnlyTheYellowLightWhenTestsAreRunning(): void
    {
        $redLight = new Light;
        $yellowLight = new Light;
        $greenLight = new Light;
        $trafficLight = new TrafficLight($redLight, $yellowLight, $greenLight);

        $trafficLight->testsAreRunning();
        $redLight->assertOff();
        $yellowLight->assertOn();
        $greenLight->assertOff();
    }

    /**
     * @return void
     */
    public function testItActivatesOnlyTheRedLightWhenTestsFailed(): void
    {
        $redLight = new Light;
        $yellowLight = new Light;
        $greenLight = new Light;
        $trafficLight = new TrafficLight($redLight, $yellowLight, $greenLight);

        $trafficLight->testsFailed();
        $redLight->assertOn();
        $yellowLight->assertOff();
        $greenLight->assertOff();
    }

    /**
     * @return void
     */
    public function testItActivatesOnlyTheGreenLightWhenTestsPassed(): void
    {
        $redLight = new Light;
        $yellowLight = new Light;
        $greenLight = new Light;
        $trafficLight = new TrafficLight($redLight, $yellowLight, $greenLight);

        $trafficLight->testsPassed();
        $redLight->assertOff();
        $yellowLight->assertOff();
        $greenLight->assertOn();
    }
}

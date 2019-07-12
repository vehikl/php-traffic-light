<?php

namespace PhpTrafficLight\Tests\Feature;

use PhpTrafficLight\Light;
use PhpTrafficLight\Tests\Fakes\TrafficLightApi;
use PhpTrafficLight\Tests\TestCase;
use PhpTrafficLight\TrafficLight;

class TrafficLightTest extends TestCase
{
    /**
     * @return void
     */
    public function testTheApiActivatesOnlyTheYellowLightWhenTestsAreRunning(): void
    {
        $api = new TrafficLightApi;
        $trafficLight = new TrafficLight(
            new Light('red', $api),
            new Light('yellow', $api),
            new Light('green', $api)
        );

        $api->assertAllLightsAreOff();
        $trafficLight->testsAreRunning();
        $api->assertOnlyLightIsOn('yellow');
    }

    /**
     * @return void
     */
    public function testTheApiActivatesOnlyTheRedLightWhenTestsFailed(): void
    {
        $api = new TrafficLightApi;
        $trafficLight = new TrafficLight(
            new Light('red', $api),
            new Light('yellow', $api),
            new Light('green', $api)
        );

        $api->assertAllLightsAreOff();
        $trafficLight->testsFailed();
        $api->assertOnlyLightIsOn('red');
    }

    /**
     * @return void
     */
    public function testTheApiActivatesOnlyTheGreenLightWhenTestsPassed(): void
    {
        $api = new TrafficLightApi;
        $trafficLight = new TrafficLight(
            new Light('red', $api),
            new Light('yellow', $api),
            new Light('green', $api)
        );

        $api->assertAllLightsAreOff();
        $trafficLight->testsPassed();
        $api->assertOnlyLightIsOn('green');
    }
}

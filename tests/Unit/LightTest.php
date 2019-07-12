<?php

namespace PhpTrafficLight\Tests\Unit;

use PhpTrafficLight\Light;
use PhpTrafficLight\Tests\TestCase;
use PhpTrafficLight\Tests\Fakes\TrafficLightApi;

final class LightTest extends TestCase
{
    /**
     * @return void
     */
    public function testItCanBeInstantiatedWithAColorAndATrafficLightApiInterface(): void
    {
        $this->assertInstanceOf(Light::class, new Light('red', new TrafficLightApi));
    }

    /**
     * @return void
     */
    public function testItActivatesTheLightThroughTheApiWhenActivated(): void
    {
        $api = new TrafficLightApi;
        $light = new Light('red', $api);

        $api->assertAllLightsAreOff();
        $light->activate();
        $api->assertOnlyLightIsOn('red');
    }

    /**
     * @return void
     */
    public function testItDeactivatesTheLightThroughTheApiWhenDeactivated(): void
    {
        $api = new TrafficLightApi;
        $light = new Light('red', $api);

        $api->assertAllLightsAreOff();
        $light->activate();
        $api->assertOnlyLightIsOn('red');

        $light->deactivate();
        $api->assertAllLightsAreOff();
    }
}

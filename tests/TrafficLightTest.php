<?php

namespace PhpTrafficLight\Tests\Unit;

use PhpTrafficLight\Light;
use PhpTrafficLight\Tests\TestCase;
use PhpTrafficLight\Tests\Fakes\TrafficLightApi;
use PhpTrafficLight\TrafficLight;

final class TrafficLightTest extends TestCase
{
    /**
     * @return void
     */
    public function testItCanBeInstantiatedWithATrafficLightApiInterface(): void
    {
        $api = new TrafficLightApi;
        $this->assertInstanceOf(
            TrafficLight::class,
            new TrafficLight(
                new Light('red', $api),
                new Light('yellow', $api),
                new Light('green', $api)
            )
        );
    }
}

<?php

namespace PhpTrafficLight\Tests\Fakes;

use http\Exception\InvalidArgumentException;
use PhpTrafficLight\Interfaces\TrafficLightApiInterface;
use PHPUnit\Framework\Assert;

class TrafficLightApi implements TrafficLightApiInterface
{
    /**
     * @const int
     */
    const LIGHT_OFF = 0;

    /**
     * @const int
     */
    const LIGHT_ON = 1;

    /**
     * @var array
     */
    private $lights = [
        'red' => self::LIGHT_OFF,
        'yellow' => self::LIGHT_OFF,
        'green' => self::LIGHT_OFF
    ];

    /**
     * @param string $id
     * @return bool
     */
    public function activateLight(string $id): bool
    {
        $this->throwExceptionIfLightDoesNotExist($id);
        $this->lights[$id] = self::LIGHT_ON;
        return true;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function deactivateLight(string $id): bool
    {
        $this->throwExceptionIfLightDoesNotExist($id);
        $this->lights[$id] = self::LIGHT_OFF;
        return true;
    }

    /**
     * @param string $id
     * @return void
     */
    public function assertLightIsOn(string $id): void
    {
        $this->throwExceptionIfLightDoesNotExist($id);
        Assert::assertEquals(
            self::LIGHT_ON,
            $this->lights[$id],
            "Failed asserting that light '{$id}' is on."
        );
    }

    /**
     * @param string $id
     * @return void
     */
    public function assertLightIsOff(string $id): void
    {
        $this->throwExceptionIfLightDoesNotExist($id);
        Assert::assertEquals(
            self::LIGHT_OFF,
            $this->lights[$id],
            "Failed asserting that light '{$id}' is off."
        );
    }

    /**
     * @return void
     */
    public function assertAllLightsAreOff(): void
    {
        foreach($this->lights as $id => $light) {
            $this->assertLightIsOff($id);
        }
    }

    /**
     * @param string $id
     * @return void
     */
    public function assertOnlyLightIsOn(string $id): void
    {
        foreach($this->lights as $lightId => $light) {
            if($lightId === $id) {
                $this->assertLightIsOn($lightId);
            }
            else {
                $this->assertLightIsOff($lightId);
            }
        }
    }

    /**
     * @param string $id
     * @return void
     */
    private function throwExceptionIfLightDoesNotExist(string $id): void
    {
        if(!isset($this->lights[$id])) {
            throw new InvalidArgumentException("There is no light with the ID '{$id}'.");
        }
    }
}

<?php

namespace PhpTrafficLight\Tests\Fakes;

use PhpTrafficLight\Interfaces\LightInterface;
use PHPUnit\Framework\Assert;

class Light implements LightInterface
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
     * @var int
     */
    private $state = self::LIGHT_OFF;

    /**
     * @return bool
     */
    public function activate(): bool
    {
        $this->state = self::LIGHT_ON;
        return true;
    }

    /**
     * @return bool
     */
    public function deactivate(): bool
    {
        $this->state = self::LIGHT_OFF;
        return true;
    }

    /**
     * @return void
     */
    public function assertOff(): void
    {
        Assert::assertEquals(self::LIGHT_OFF, $this->state, 'Failed asserting that light is off.');
    }

    /**
     * @return void
     */
    public function assertOn(): void
    {
        Assert::assertEquals(self::LIGHT_ON, $this->state, 'Failed asserting that light is on.');
    }
}

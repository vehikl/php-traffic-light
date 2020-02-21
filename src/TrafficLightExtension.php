<?php

namespace PhpTrafficLight;

use PhpTrafficLight\Hue\HueApi;
use PHPUnit\Runner\AfterLastTestHook;
use PHPUnit\Runner\AfterTestErrorHook;
use PHPUnit\Runner\AfterTestFailureHook;
use PHPUnit\Runner\BeforeFirstTestHook;
use PHPUnit\Runner\TestHook;

class TrafficLightExtension implements
    TestHook,
    BeforeFirstTestHook,
    AfterLastTestHook,
    AfterTestFailureHook,
    AfterTestErrorHook
{
    /**
     * @const int
     */
    const RED_LIGHT_ID = 4;

    /**
     * @const int
     */
    const YELLOW_LIGHT_ID = 6;

    /**
     * @const int
     */
    const GREEN_LIGHT_ID = 5;

    /**
     * @var TrafficLight
     */
    private static $trafficLight;

    /**
     * @var bool
     */
    private static $hasFailure = false;

    /**
     * @var bool
     */
    private $enabled = false;

    /**
     * @return void
     */
    public function __construct()
    {
        if(getenv('TRAFFIC_LIGHT_ENABLED') !== '1') {
            return;
        }

        $this->enabled = true;
        $api = new HueApi;

        self::$trafficLight = new TrafficLight(
            new Light(self::RED_LIGHT_ID, $api),
            new Light(self::YELLOW_LIGHT_ID, $api),
            new Light(self::GREEN_LIGHT_ID, $api)
        );
    }

    /**
     * @return void
     */
    public function executeBeforeFirstTest(): void
    {
        if(!$this->isEnabled()) {
            return;
        }

        self::$trafficLight->testsAreRunning();
    }

    /**
     * @param string $test
     * @param string $message
     * @param float $time
     * @return void
     */
    public function executeAfterTestError(string $test, string $message, float $time): void
    {
        self::$hasFailure = true;
    }

    /**
     * @param string $test
     * @param string $message
     * @param float $time
     * @return void
     */
    public function executeAfterTestFailure(string $test, string $message, float $time): void
    {
        self::$hasFailure = true;
    }

    /**
     * @return void
     */
    public function executeAfterLastTest(): void
    {
        if(!$this->isEnabled()) {
            return;
        }

        if (self::$hasFailure) {
            self::$trafficLight->testsFailed();
            return;
        }

        self::$trafficLight->testsPassed();
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}

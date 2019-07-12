<?php

namespace PhpTrafficLight;

use PhpTrafficLight\Hue\HueApi;
use PhpTrafficLight\Hue\HueCredentials;
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
        $api = new HueApi(new HueCredentials(
            getenv('TRAFFIC_LIGHT_CLIENT_ID'),
            getenv('TRAFFIC_LIGHT_CLIENT_SECRET')
        ));

        self::$trafficLight = new TrafficLight(
            new Light('red', $api),
            new Light('yellow', $api),
            new Light('green', $api)
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

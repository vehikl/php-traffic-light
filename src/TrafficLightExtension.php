<?php

namespace PhpTrafficLight;

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
     * @return void
     */
    public function __construct()
    {
        $api = new HueApi;
        self::$trafficLight = new TrafficLight(
            new Light('red', $api),
            new Light('yellow', $api),
            new Light('green', $api)
        );

        self::$trafficLight->testsAreRunning();
    }

    /**
     * @return void
     */
    public function executeBeforeFirstTest(): void
    {
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
        if (self::$hasFailure) {
            self::$trafficLight->testsFailed();
            return;
        }

        self::$trafficLight->testsPassed();
    }
}

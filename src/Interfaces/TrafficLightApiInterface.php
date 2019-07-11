<?php

namespace PhpTrafficLight\Interfaces;

interface TrafficLightApiInterface
{
    public function activateLight(string $id): bool;

    public function deactivateLight(string $id): bool;
}

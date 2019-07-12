<?php

namespace PhpTrafficLight;

use PhpTrafficLight\Interfaces\TrafficLightApiInterface;

class HueApi implements TrafficLightApiInterface
{
    /**
     * @param string $id
     * @return bool
     */
    public function activateLight(string $id): bool
    {
        echo "Light '{$id}' is ON.\n";
        return true;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function deactivateLight(string $id): bool
    {
        echo "Light '{$id}' is OFF.\n";
        return true;
    }
}

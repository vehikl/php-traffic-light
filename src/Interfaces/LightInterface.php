<?php

namespace PhpTrafficLight\Interfaces;

interface LightInterface
{
    public function activate(): bool;

    public function deactivate(): bool;
}

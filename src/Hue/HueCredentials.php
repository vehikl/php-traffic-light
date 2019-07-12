<?php

namespace PhpTrafficLight\Hue;

class HueCredentials
{
    /**
     * @var string
     */
    private $bridgeIp;

    /**
     * @var string
     */
    private $bridgeUser;

    /**
     * @param string $bridgeIp
     * @param string $bridgeUser
     * @return void
     */
    public function __construct(string $bridgeIp, string $bridgeUser)
    {
        $this->bridgeIp = $bridgeIp;
        $this->bridgeUser = $bridgeUser;
    }

    /**
     * @return string
     */
    public function getBridgeIp(): string
    {
        return $this->bridgeIp;
    }

    /**
     * @return string
     */
    public function getBridgeUser(): string
    {
        return $this->bridgeUser;
    }
}

# PHP Traffic Light

## Requirements

* PHP ^= 7.1
* PHPUnit ^= 7.1

## Installation

```
composer install vehikl/php-traffic-light
```

## Usage

Implementation is extremely simple. Add the following to your `phpunit.xml` file:

```xml
<extensions>
    <extension class="PhpTrafficLight\TrafficLightExtension" />
</extensions>
```

Additionally, you must ensure that your environment has three relevant environment variables:
* `TRAFFIC_LIGHT_ENABLED` - this determines if the plugin is enabled. This should only be true (`1`) on the mobbing computer.
* `TRAFFIC_LIGHT_BRIDGE_IP` - this comes from Hue somehow
* `TRAFFIC_LIGHT_BRIDGE_USER` - this comes from Hue somehow

That's it! The traffic light in the lounge should now reflect the state of the mobbing tests.

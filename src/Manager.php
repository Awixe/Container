<?php
/*
 * This file is part of Awixe/Container
 *
 * GNU GENERAL PUBLIC LICENSE
 * Version 3, 29 June 2007
 *
 * Copyright (C) 2007 Free Software Foundation, Inc. <http://fsf.org/>
 * Everyone is permitted to copy and distribute verbatim copies
 * of this license document, but changing it is not allowed.
 *
 * <https://github.com/Awixe/Container/blob/master/LICENSE>
 *
 */

namespace Awixe\Container;

use Awixe\Container\Exception\InvalidServiceReference;
use Awixe\Container\Configuration;
use Pimple\Container as PimpleContainer;
use Traversable;

define('ROOT_APPLICATION', __DIR__.'/../../../../');

class Manager extends Container implements ManagerInterface
{
    public static function factory($servicesToCall = [])
    {
        if (!($servicesToCall instanceof Traversable || is_array($servicesToCall))) {
            throw new InvalidServiceReference('Not compatible with the foreach method.');
        }
        $container = new PimpleContainer();
        foreach ($servicesToCall as $service) {
            if (!is_string($service)) {
                throw new InvalidServiceReference('Array values need to be passed as strings.');
            }
            $path = ROOT_APPLICATION.ltrim(rtrim($custompath, '/\\'), '/\\')."/{$service}.php";
            if (!file_exists($path)) {
               throw new InvalidServiceReference('A service does not exist.');
            }
            require_once 
            if (isset($servicesToCall['protectServices'])) {
                foreach ($servicesToCall['protectServices'] as $service) {
                    if (!in_array($service, $servicesToCall)) {
                        continue;
                    }
                    $container[$service] = $container->protect(function () {
                        return $service();
                    });
                }
            }
            foreach ($servicesToCall as $service) {
                $container[$service] = $container->factory(function ($container) {
                    if (isset($servicesToCall['sevicesLinks'][$service])) {
                        return new $service(self::passServices($servicesToCall['sevicesLinks'][$service], $container));
                    }

                    return new $service();
                });
            }
        }
        static::setContainer($container);

        return $container;
    }

    public function __invoke(string $service = null)
    {
        return static::initialize($service);
    }

    private static function passServices($servicesToCall, $container)
    {
        $passing = [];
        foreach ($servicesToCall as $service) {
            if (isset($container[$service])) {
                $passing += [
                    $container[$service],
                ];
            }
        }

        return $passing;
    }
}

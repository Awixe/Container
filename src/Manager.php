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

use Awixe\Container\Exception\InvalidBaseConfiguration;
use Awixe\Container\Exception\InvalidServiceReference;
use Pimple\Container as PimpleContainer;
use Traversable;

define('ROOT_APPLICATION', __DIR__  . '/../../../../');

class Manager extends Container implements ManagerInterface
{
    public function __invoke($servicesToCall = [], array $baseConfiguration = array())
    {
        if (!($servicesToCall instanceof Traversable || is_array($servicesToCall))) {
            throw new InvalidServiceReference($servicesToCall);
        }
        $container = new PimpleContainer();
        if (empty($baseConfiguration)) {
            throw new InvalidBaseConfigurationException('No data was provided.');
        }
        $services = isset($baseConfiguration['services'] ? $baseConfiguration['services'] : null;
        $customPath = isset($baseConfiguration['servicesPath']) ? $baseConfiguration['servicesPath'] : '';
        if (!$services) {
            throw new InvalidBaseConfigurationException('No services to call.');
        }
        if (!is_string($customPath)) {
            throw new InvalidBaseConfigurationException('Invalid path location.');
        }
        foreach ($services as $service) {
            if (!is_string($service)) {
                throw new InvalidBaseConfigurationException('Array values need to be passed as strings.');
            }
            require_once ROOT_APPLICATION . rtrim($custompath, '/\\') . "/{$service}.php";
        }
      
        
    }
}

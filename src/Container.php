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

use Awixe\Exception\NotInstanceOfPimpleException;
use Pimple\Container as PimpleContainer;

class Container
{
    protected static $instance;

    protected static function initialize(string $service = null)
    {
        if (!(self::$instance instanceof PimpleContainer)) {
            throw new NotInstanceOfPimpleException(self::$container);
        }
        $container = self::$instance;
        if (is_null($service)) {
            return $container;
        } elseif (!isset($container[$service])) {
            throw new UnknownService($service);
        } else {
            return $container[$service];
        }
    }

    protected static function getInstance()
    {
        if (!(self::$instance instanceof PimpleContainer)) {
            throw new NotInstanceOfPimpleException(self::$container);
        }

        return self::$instance;
    }

    protected static function setConatiner(PimpleContainer $container)
    {
        self::$instance = $container;
    }
}

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
use Traversable;

class Manager extends Container implements ManagerInterface
{
    public function __invoke($servicesToCall = [])
    {
        if (!($servicesToCall instanceof Traversable) && !is_array($servicesToCall)) {
            throw new InvalidServiceReference($servicesToCall);
        }
    }
}

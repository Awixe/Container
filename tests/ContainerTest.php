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

namespace Awixe\Container\Tests;

use Awixe\Container\Container;
use Awixe\Container\Exception\NotInstanceOfPimpleException;
use Awixe\Container\Exception\UnknownServiceException;
use PHPUnit\Framework\TestCase;
use Pimple\Container as PimpleContainer;

final class ContainerTest extends TestCase
{
    public function intializeTest() {
        $container = new PimpleContainer();
        $service = 'fromString';
        $value = 'randomValue';
        $container[$service] = $value;
        Container::setContainer($container);
        $this->assertInstanceOf(
            PimpleContainer::class,
            Container::initialize()
        );
    }
    public function intializeTest2() {
        $container = new PimpleContainer();
        $service = 'fromString';
        Container::setContainer($container);
        $this->expectException(UnknownSrviceException::class);
    }
    public function getInstanceTest() {
        $container = new PimpleContainer();
        $container['fromString'] = 'Hello world!';
        Container::setContainer($container)
        $this->assertInstanceOf(
            PimpleContainer::class,
            Container::getInstance()
        );
    }
    public function setContainerTest() {
    }
}

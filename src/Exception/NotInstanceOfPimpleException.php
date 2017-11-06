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
 */
namespace Awixe\Container\Exception;
use Psr\Container\NotFoundExceptionInterface;
class NotInstanceOfPimpleException extends \InvalidArgumentException implements NotFoundExceptionInterface {
    function __construct($container) {
        parent::__construct(sprintf('Invalid instance of pimple. `%s`', var_export($container)));
    }
}
?>

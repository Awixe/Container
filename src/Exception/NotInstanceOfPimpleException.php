<?php
namespace Awixe\Container\Exception;
use Psr\Container\NotFoundExceptionInterface;
class NotInstanceOfPimpleException extends \InvalidArgumentException implements NotFoundExceptionInterface {
    function __construct($container) {
        parent::__construct(sprintf('Invalid instance of pimple. `%s`', var_export($container)));
    }
}
?>

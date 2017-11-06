<?php
namespace Awixe\Container\Exception;
use Psr\Container\NotFoundExceptionInterface;
class NotInstanceOfPimpleException extends \InvalidArgumentException implements NotFoundExceptionInterface {
}
?>

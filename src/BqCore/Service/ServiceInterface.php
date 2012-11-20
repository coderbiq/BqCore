<?php
namespace BqCore\Service;

use Zend\ServiceManager\ServiceLocatorInterface,
    Zend\ServiceManager\ServiceLocatorAwareInterface;

interface ServiceInterface extends ServiceLocatorAwareInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator);
}

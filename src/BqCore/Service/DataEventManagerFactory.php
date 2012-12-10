<?php
namespace BqCore\Service;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;
use Zend\EventManager\EventManager;

class DataEventManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $eventManager = new EventManager();
        $eventManager->setIdentifiers('bqcore.data.eventmanager');
        return $eventManager;
    }
}

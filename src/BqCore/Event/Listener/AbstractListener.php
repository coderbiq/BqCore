<?php

namespace BqCore\Event\Listener;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;

abstract class AbstractListener implements ListenerAggregateInterface, FactoryInterface, 
    ServiceLocatorAwareInterface
{
    protected $listeners = array();
    protected $serviceLocator;

    public function detach(EventManagerInterface $events) {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $this->setServiceLocator($serviceLocator);
        return $this;
    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

}

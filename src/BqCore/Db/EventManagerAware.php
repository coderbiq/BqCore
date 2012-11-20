<?php
namespace BqCore\Db;

use Zend\EventManager\EventManagerAwareInterface,
    Zend\EventManager\EventManagerInterface,
    Zend\EventManager\EventManager;

class EventManagerAware implements EventManagerAwareInterface
{
    protected $eventManager;

    public function getIdentifiers() {
        return 'BqCore.Db';
    }

    public function setEventManager(EventManagerInterface $eventManager)
    {
        $eventManager->setIdentifiers($this->getIdentifiers());
        $this->eventManager = $eventManager;
        return $this;
    }

    public function getEventManager()
    {
        if (!$this->eventManager instanceof EventManagerInterface) {
            $this->setEventManager(new EventManager());
        }
        return $this->eventManager;
    }
}

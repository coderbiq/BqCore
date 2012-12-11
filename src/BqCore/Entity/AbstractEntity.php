<?php
namespace BqCore\Entity;

use Zend\Db\RowGateway\RowGateway;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManagerAwareInterface;
use BqCore\Event\DataEvent;

abstract class AbstractEntity extends RowGateway implements EntityInterface, 
    EventManagerAwareInterface
{
    protected $eventManager;

    public function getId() { return $this->id; }

    public function getEventManager() { return $this->eventManager; }
    public function setEventManager(EventManagerInterface $eventManager) {
        $this->eventManager = $eventManager;
        return $this;
    }

    public function save() {
        if(!isset($this->id) || empty($this->id)) {
            $eventName     = DataEvent::EVENT_INSERT;
            $postEventName = DataEvent::EVENT_INSERT_POST;
        } else {
            $eventName     = DataEvent::EVENT_CHANGE;
            $postEventName = DataEvent::EVENT_CHANGE_POST;
        }

        $eventManager = $this->getEventManager();
        $event = new DataEvent();
        $event->setTarget($this)->setName($eventName);
        $eventManager->trigger($event);

        $result = parent::save();

        $event->setName($postEventName);
        $eventManager->trigger($event);
        
        return $result;
    }
}

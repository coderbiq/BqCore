<?php
namespace BqCore\Event;

use Zend\EventManager\Event;

class EntityEvent extends Event
{
    const EVENT_GET_RELYON_ENTITY = 'bqcore.entity.get.relyon.entity';

    protected $relyonEntityName;

    public function getRelyonEntityName() { return $this->relyonEntityName; }
    public function setRelyonEntityName($name) {
        $this->relyonEntityName = $name;
        return $this;
    }
}

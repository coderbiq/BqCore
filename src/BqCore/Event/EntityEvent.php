<?php
namespace BqCore\Event;

use Zend\EventManager\Event;

class EntityEvent extends Event
{
    const EVENT_GET_RELYON_ENTITIES = 'bqcore.entity.get.relyon.entities';

    protected $relyonEntityName;
    protected $relyonEntityIds;

    public function getRelyonEntityName() { return $this->relyonEntityName; }
    public function setRelyonEntityName($name) {
        $this->relyonEntityName = $name;
        return $this;
    }

    public function getRelyonEntityIds() { return $this->relyonEntityIds; }
    public function setRelyonEntityIds(Array $ids) {
        $this->relyonEntityIds = $ids;
        return $this;
    }
}

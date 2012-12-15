<?php
namespace BqCore\Event;

use Zend\EventManager\Event;
use BqCore\Entity\EntityInterface;

class EntityEvent extends Event
{
    const EVENT_GET_RELYON_ENTITIES = 'bqcore.entity.get.relyon.entities';
    const EVENT_ADD_RELYON_ENTITY = 'bqcore.entity.add.relyon.entity';

    protected $relyonEntityName;
    protected $relyonEntityIds;
    protected $relyonEntity;

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

    public function getRelyonEntity() { return $this->relyonEntity; }
    public function setRelyonEntity(EntityInterface $entity) {
        $this->relyonEntity = $entity;
        return $this;
    }
}

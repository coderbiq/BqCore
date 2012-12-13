<?php
namespace BqCore\Entity;

class Relyon
{
    protected $entity;

    public function getEntity() { return $this->entity; }
    public function setEntity(EntityInterface $entity) {
        $this->entity = $entity;
        return $this;
    }
}

<?php

namespace BqCore\Entity;

interface ManagerInterface {
    public function createEntity();
    public function getEntities(Array $ids, Array $params=array());
    public function getEntityName();
}

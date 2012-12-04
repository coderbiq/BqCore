<?php
namespace BqCore\Db\Table;

use Zend\EventManager\Event as ZendEvent;

class Event extends ZendEvent
{
    protected $table;

    public function getTable() { return $this->table; }
    public function setTable(TableInterface $table) {
        $this->table = $table;
        return $this;
    }
}

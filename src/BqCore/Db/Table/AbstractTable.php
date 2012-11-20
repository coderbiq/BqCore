<?php
namespace BqCore\Db\Table;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\ResultSet\ResultSet;
use BqCore\Db\EventManager;

abstract class AbstractTable extends AbstractTableGateway 
    implements TableInterface
{
    public function __construct() {
        $this->bootstrap();
    }

    public function bootstrap() {
        $eventManager = new EventManagerAware();

        $event = new Event();
        $event->setTarget($this);
        $event->setName(Event::BOOTSTRAP);

        $eventManager->getEventManager()->trigger($event);

        $this->table = static::getTableName();

        $event->setName(Event::BOOTSTRAP_POST);
        $eventManager->getEventManager()->trigger($event);
    }
}

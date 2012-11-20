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
        $event = new Event();
        $event->setTarget($this);
        $event->setName(__FUNCTION__);
        $eventManager = new EventManagerAware();
        $eventManager->getEventManager()->trigger($event);

        $this->table = static::getTableName();

        $event->setName(sprintf('%s.post', __FUNCTION__));
        $eventManager->getEventManager()->trigger($event);
    }
}

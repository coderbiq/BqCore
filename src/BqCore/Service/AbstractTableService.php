<?php
namespace BqCore\Service;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;
use BqCore\Db\Table\TableInterface;
use BqCore\Entity\ManagerInterface as EntityManagerInterface;
use BqCore\Event\DataEvent;
use BqCore\Entity\AbstractEntity;

abstract class AbstractTableService extends AbstractTableGateway
    implements EntityManagerInterface, TableServiceInterface
{
    protected $serviceLocator;

    public function getEntities(Array $ids, Array $params=array()) {
        $entities = $this->select(function($select) use($ids, $params) {
            $select->where(array('id'=>$ids));
            if(isset($params['limit']))
                $select->limit(intval($params['limit']));
            if(isset($params['offset']))
                $select->offset(intval($params));
        });
        return $entities;
    }

    public function search(Array $params=array()) {
        $event = new DataEvent();
        $event->setTarget($this)->setParams($params)
            ->setName(DataEvent::EVENT_SEARCH);
        $eventManager = $this->getServiceLocator()
            ->get('BqCore\Data\EventManager');
        $eventManager->trigger($event);

        $resultSet = $this->select(function($select) use($params) {
            if(isset($params['limit'])) {
                $select->limit(intval($params['limit']));
                unset($params['limit']);
            }
            if(isset($params['offset'])) {
                $select->offset(intval($params['offset']));
                unset($params['offset']);
            }
            $select->where($params);
        });

        $event->setResultSet($resultSet)->setName(DataEvent::EVENT_SEARCH_POST);
        $eventManager->trigger($event);

        return $resultSet;
    }

    public function delete($where) {
        $event = new DataEvent();
        $event->setTarget($this)->setParams($where)
            ->setName(DataEvent::EVENT_DELETE);
        $eventManager = $this->getServiceLocator()
            ->get('BqCore\Data\EventManager');
        $eventManager->trigger($event);

        $result = parent::delete($where);

        $event->setName(DataEvent::EVENT_DELETE_POST);
        $eventManager->trigger($event);

        return $result;
    }

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $this->setServiceLocator($serviceLocator);

        $this->table = static::getTableName();

        $adapter = $this->getServiceLocator()
            ->get(static::getAdapterServiceName());
        $this->adapter = $adapter;

        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(
            $this->createEntity());

        return $this;

    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    protected function parseEntity(AbstractEntity $entity) {
        $entity->setEventManager($this->getServiceLocator()
            ->get('BqCore\Data\EventManager'));
        return $entity;
    }
}

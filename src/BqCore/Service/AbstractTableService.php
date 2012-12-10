<?php
namespace BqCore\Service;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;
use BqCore\Db\Table\TableInterface;
use BqCore\Entity\FactoryInterface as EntityFactoryInterface;

abstract class AbstractTableService extends AbstractTableGateway
    implements EntityFactoryInterface, TableServiceInterface
{
    protected $serviceLocator;

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

}

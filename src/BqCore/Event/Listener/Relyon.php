<?php
namespace BqCore\Event\Listener;

use Zend\EventManager\EventManagerInterface;
use BqCore\Event\EntityEvent;
use BqCore\Entity\ManagerInterface as EntityManagerInterface;
use BqCore\Entity\Relyon as RelyonResult;

class Relyon extends AbstractListener
{
    public function attach(EventManagerInterface $events) {
        $this->listeners[] = $events->attach(
            EntityEvent::EVENT_GET_RELYON_ENTITIES,
            array($this, 'onGetRelyonEntities'),
            -100
        );
    }

    public function onGetRelyonEntities($event) {
        $entityName = $event->getRelyonEntityName();
        $entityIds = $event->getRelyonEntityIds();
        if(count($entityIds) < 1)
            return null;
        if(!$entityService = $this->getEntityService($entityName))
            return null;
        $params = $event->getParams();

        $entities = $entityService->getEntities($entityIds, $params);
        return new RelyonResult($entities);
    }

    protected function getEntityService($entityName) {
        $config = $this->getServiceManager()->get('Configuration');
        if(!isset($config['entities'][$entityName]['service']))
            return false;

        $serviceName = $config['entities'][$entityName]['service'];
        if(!$this->getServiceLocator()->has($serviceName))
            return false;

        $service = $this->getServiceLocator()->get($serviceName);
        if(!$service instanceof EntityManagerInterface)
            return false;

        return $service;
    }
}

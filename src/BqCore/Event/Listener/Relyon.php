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

        $entityManagerAware = $this->getServiceLocator()
            ->get('BqCore\EntityManagerAware')
            ->getEntityManager($entityName);
        if(!$entityService)
            return null;

        $params = $event->getParams();
        $entities = $entityService->getEntities($entityIds, $params);

        return new RelyonResult($entities);
    }
}

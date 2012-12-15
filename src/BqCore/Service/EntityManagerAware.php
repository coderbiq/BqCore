<?php
namespace BqCore\Service;

class EntityManagerAware extends AbstractService
{
    public function getEntityManager($entityName) {
        $config = $this->getServiceLocator()->get('Configuration');
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

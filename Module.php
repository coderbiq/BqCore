<?php

namespace BqCore;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements AutoloaderProviderInterface, ServiceProviderInterface
{
    public function onBootstrap($event)
    {
        $serviceManager = $event->getApplication()->getServiceManager();
        $dataEventManager = $serviceManager->get('BqCore\Data\EventManager');
        $dataEventManager->attach(
            $serviceManager->get('BqCore\Event\Listener\Relyon'));
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'BqCore\Data\EventManager' => 
                    'BqCore\Service\DataEventManagerFactory',
                'BqCore\Event\Listener\Relyon' 
                    => 'BqCore\Event\Listener\Relyon',
            ),
        );
    }
}

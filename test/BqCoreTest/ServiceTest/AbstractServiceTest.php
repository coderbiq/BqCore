<?php

namespace BqCoreTest\ServiceTest;

use PHPUnit_Framework_TestCase;
use Zend\Mvc\Application;

class AbstractServiceTest extends PHPUnit_Framework_TestCase
{
    const ABSTRACT_SERVICE = 'BqCore\Service\AbstractService';

    protected $_app;

    public function testCreate() {
        $service_manager = $this->_app->getServiceManager();

        $service = $this->getMockForAbstractClass(self::ABSTRACT_SERVICE);
        $this->assertInstanceOf(
            'BqCore\Service\ServiceInterface', 
            $service->createService($service_manager));
    }

    public function testGetServiceLocator() {
        $service_manager = $this->_app->getServiceManager();

        $service = $this->getMockForAbstractClass(self::ABSTRACT_SERVICE)
            ->createService($service_manager);
        $this->assertEquals($service_manager, $service->getServiceLocator());
    }

    protected function setUp() {
        $this->_app = Application::init(include 'config/application.config.php');
    }
}

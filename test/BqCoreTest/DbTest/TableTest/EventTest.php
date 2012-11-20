<?php
namespace BqCoreTest\DbTest\TableTest;

use PHPUnit_Framework_TestCase;
use Zend\Mvc\Application;
use BqCore\Db\Table\Event as TableEvent;

class EventTest extends PHPUnit_Framework_TestCase
{
    protected $_app;

    public function testInstance() {
        $event = new TableEvent();
        $this->assertInstanceOf('Zend\EventManager\EventInterface', $event);
    }

    protected function setUp() {
        $this->_app = Application::init(include 'config/application.config.php');
    }
}

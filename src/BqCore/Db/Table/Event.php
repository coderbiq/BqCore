<?php
namespace BqCore\Db\Table;

use Zend\EventManager\Event as ZendEvent;

class Event extends ZendEvent
{
    const BOOTSTRAP      = 'BqCore.Db.Table.Bootstrap';
    const BOOTSTRAP_POST = 'BqCore.Db.Table.Bootstrap.Post';
}

<?php
namespace BqCore\Event;

use Zend\EventManager\Event;

class DataEvent extends Event
{
    const EVENT_SEARCH      = 'bqcore.data.search';
    const EVENT_SEARCH_POST = 'bqcore.data.search.post';
    const EVENT_INSERT      = 'bqcore.data.insert';
    const EVENT_INSERT.POST = 'bqcore.data.insert.post';
    const EVENT_DELETE      = 'bqcore.data.delete';
    const EVENT_DELETE_POST = 'bqcore.data.delete.post';
    const EVENT_CHANGE      = 'bqcore.data.change';
    const EVENT_CHANGE_POST = 'bqcore.data.change.post';
}
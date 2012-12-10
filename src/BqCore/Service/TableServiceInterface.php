<?php
namespace BqCore\Service;

interface TableServiceInterface extends ServiceInterface
{
    public static function getAdapterServiceName();
    public static function getTableName();
}

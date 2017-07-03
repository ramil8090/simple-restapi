<?php

namespace MySimple\RestApp\Core\Abstracts;


use \MySimple\RestApp\Core\Abstracts\AbstractContext;
use Slim\PDO\Database;


abstract class AbstractModel
{
    protected $db;

    function __construct(Database $db)
    {
        $this->db = $db;
    }

    abstract public static function table();
    abstract public static function attributes();

}
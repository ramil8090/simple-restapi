<?php


namespace MySimple\RestApp\Core;


use MySimple\RestApp\Core\Abstracts\AbstractConfiguration;
use MySimple\RestApp\Core\Abstracts\AbstractContext;
use MySimple\RestApp\Core\Abstracts\AbstractIdentity;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;
use Slim\PDO\Database;


class ApplicationContext extends AbstractContext
{
    public $config;
    public $request;
    public $db;

    function __construct(
        AbstractConfiguration $config,
        RequestInterface $request,
        Database $db,
        AbstractIdentity $identity,
        LoggerInterface $logger=null
    )
    {
        parent::__construct($identity, $logger);
        $this->config = $config;
        $this->request = $request;
        $this->db = $db;
    }
}
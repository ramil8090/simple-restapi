<?php


namespace MySimple\RestApp\Core\Abstracts;

use GuzzleHttp\Psr7\Request;
use MySimple\RestApp\Core\ApplicationContext;
use MySimple\RestApp\Core\Identity\TokenIdentity;
use Vespula\Log\Exception;
use Vespula\Log\Log;
use Vespula\Log\Adapter\ErrorLog;

abstract class AbstractApplication
{
    protected $config;
    protected $logger;
    protected $request;
    protected $context;

    function __construct(AbstractConfiguration $config)
    {
        session_start();
        $this->config = $config;
        $this->initLogger();
        $this->initRequest();
        $this->initContext();
    }

    abstract public function run();
    abstract protected function initLogger();
    abstract protected function initRequest();
    abstract protected function initContext();

}
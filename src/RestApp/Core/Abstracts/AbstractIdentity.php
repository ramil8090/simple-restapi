<?php


namespace MySimple\RestApp\Core\Abstracts;


use Psr\Log\LoggerInterface;
use Vespula\Log\Adapter\ErrorLog;
use Vespula\Log\Log;


abstract class AbstractIdentity
{
    protected $username='guest';
    protected $role='guest';
    protected $isGuest=true;
    protected $logger;

    function __construct(LoggerInterface $logger=null)
    {
        if($logger == null) {
            $adapter = new ErrorLog(ErrorLog::TYPE_PHP_LOG);
            $logger = new Log($adapter);
        }
        $this->logger = $logger;
    }

    public function getUsername() : string
    {
        return $this->username;
    }
    public function getRole() : string
    {
        return $this->role;
    }

    public function isGuest() : bool
    {
        return ($this->role == 'guest');
    }
}
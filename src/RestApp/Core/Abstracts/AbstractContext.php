<?php


namespace MySimple\RestApp\Core\Abstracts;


use MySimple\RestApp\Core\Abstracts\AbstractIdentity;
use Psr\Log\LoggerInterface;
use Vespula\Log\Adapter\ErrorLog;
use Vespula\Log\Log;


abstract class AbstractContext
{
    protected $logger;
    protected $extra = array();
    public $identity;

    function __construct(AbstractIdentity $identity, LoggerInterface $logger=null)
    {
        if($logger == null) {
            $adapter = new ErrorLog(ErrorLog::TYPE_PHP_LOG);
            $logger = new Log($adapter);
        }
        $this->logger = $logger;
        $this->identity = $identity;
    }

    /**
     * @return string
     */
    public function getExtra($param): string
    {
        if(false === in_array($param, array_keys($this->extra))) {
            return '';
        }

        return $this->extra[$param];
    }

    /**
     * @param string $param
     * @param string $value
     */
    public function setExtra(string $param, string $value)
    {
        $this->extra[$param] = $value;
    }
}
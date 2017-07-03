<?php


namespace MySimple\RestApp\Core\Identity;


use MySimple\RestApp\Core\Abstracts\AbstractConfiguration;
use MySimple\RestApp\Core\Abstracts\AbstractIdentity;
use Psr\Log\LoggerInterface;
use Vespula\Log\Exception;


class Identity extends AbstractIdentity
{
    protected $config;


    function __construct(AbstractConfiguration $config, LoggerInterface $logger=null)
    {
        parent::__construct($logger);
        $this->config = $config;
    }

}
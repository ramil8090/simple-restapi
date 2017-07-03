<?php


namespace MySimple\RestApp\Core\Abstracts;


abstract class AbstractService
{
    protected $logger;
    protected $context;

    function __construct(\Psr\Log\LoggerInterface $logger, AbstractContext $context)
    {
        $this->logger = $logger;
        $this->context = $context;
    }

}
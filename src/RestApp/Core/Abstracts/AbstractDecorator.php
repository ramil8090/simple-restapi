<?php


namespace MySimple\RestApp\Core\Abstracts;


use MySimple\RestApp\Core\Interfaces\ExecuterInterface;
use Psr\Log\LoggerInterface;


abstract class AbstractDecorator implements ExecuterInterface{
    
    protected $wrapper;
    protected $logger;
    protected $context;
    
    public function __construct(ExecuterInterface $wrapper, LoggerInterface $logger, AbstractContext $context) {
        $this->wrapper = $wrapper;
        $this->logger = $logger;
        $this->context = $context;
    }
    
}

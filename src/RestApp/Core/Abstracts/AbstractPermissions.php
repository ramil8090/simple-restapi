<?php


namespace MySimple\RestApp\Core\Abstracts;


use Psr\Log\LoggerInterface;

abstract class AbstractPermissions {
    
    protected $rules;
    protected $logger;
    
    public function __construct(array $rules, LoggerInterface $logger) {
        $this->rules = $rules;
        $this->logger = $logger;
    }
    
    public abstract function hasPermissions($entity, $action, $role);
}

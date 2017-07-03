<?php


namespace MySimple\RestApp\Core\Decorators;


use MySimple\RestApp\Core\Abstracts\AbstractContext;
use MySimple\RestApp\Core\Abstracts\AbstractDecorator;
use MySimple\RestApp\Core\Abstracts\AbstractPermissions;
use MySimple\RestApp\Core\Interfaces\ExecuterInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;


class PermissionsDecorator  extends AbstractDecorator {
    
    protected $permissions;

    public function __construct(ExecuterInterface $class, LoggerInterface $logger, AbstractContext $context, AbstractPermissions $permissions) {
        
        parent::__construct($class, $logger, $context);
        
        $this->permissions = $permissions;
    }
    
    public function exec($controller, $action, $params)
    {
        if (DEBUG_MODE) {
            $this->logger->log(LogLevel::INFO, "Permissions Decorator ".$controller." action ".$action);
        }

        $role = $this->context->identity->getRole();
        if(!$this->permissions->hasPermissions($controller, $action, $role)){
            header('HTTP/1.0 403 Forbidden');
            die;
        } 
        
        return $this->wrapper->exec($controller, $action, $params);
    }
    
    
}

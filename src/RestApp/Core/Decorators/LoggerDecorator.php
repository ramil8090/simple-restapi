<?php


namespace MySimple\RestApp\Core\Decorators;


use MySimple\RestApp\Core\Abstracts\AbstractDecorator;
use MySimple\RestApp\Core\Interfaces\ExecuterInterface;
use Psr\Log\LoggerInterface;


class LoggerDecorator extends AbstractDecorator {
    
    protected $logger;
    
    public function __construct(ExecuterInterface $class, LoggerInterface $logger) {
        parent::__construct($class);
        $this->logger = $logger;        
    }
    
    public function exec($controller, $action, $params) {
        echo "Logger Decorator ".$controller." action ".$action."\n";
        
        $this->logger->info("Logger Decorator {controller} action {action}", array(
            'controller'=>$controller,
            'action'=>$action
        ));
        
        return $this->wrapper->exec($controller, $action, $params);
    }
    
}

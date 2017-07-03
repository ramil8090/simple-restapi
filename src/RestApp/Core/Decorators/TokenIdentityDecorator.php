<?php


namespace MySimple\RestApp\Core\Decorators;


use MySimple\RestApp\Core\Abstracts\AbstractContext;
use MySimple\RestApp\Core\Abstracts\AbstractDecorator;
use MySimple\RestApp\Core\Identity\TokenIdentity;
use MySimple\RestApp\Core\Interfaces\ExecuterInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;


class TokenIdentityDecorator extends AbstractDecorator {
    
    protected $request;
    protected $context;

    public function __construct(ExecuterInterface $class,
                                LoggerInterface $logger,
                                RequestInterface $request,
                                AbstractContext $context) {
        parent::__construct($class, $logger);
        $this->request = $request;
        $this->context = $context;
    }
    
    public function exec($controller, $action, $params) {
        echo "Auth Decorator ".$controller." action ".$action."\n";
        return $this->wrapper->exec($controller, $action, $params);

    }
    
}

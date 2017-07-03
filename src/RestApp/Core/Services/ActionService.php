<?php


namespace MySimple\RestApp\Core\Services;


use MySimple\RestApp\Core\Abstracts\AbstractService;
use MySimple\RestApp\Core\Interfaces\ExecuterInterface;


class ActionService extends AbstractService implements ExecuterInterface{
    
    
    public function exec($controller, $action, $params)
    {
        $controller = 'MySimple\\RestApp\\Controllers\\'. ucfirst($controller). 'Controller';
        $action = $action.'Action';
        //echo "Action executer controller ".$controller." action ".$action."\n";
        $controller = new $controller($this->context, $this->logger);

        return call_user_func_array(array($controller, $action), $params);
    }

}

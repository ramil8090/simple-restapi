<?php


namespace MySimple\RestApp\Core\Routers;


use MySimple\RestApp\Core\Abstracts\AbstractRouter;


class Router extends AbstractRouter
{

    public function run() : void
    {
        try
        {
            list(
                $controller,
                $action,
                $params) = $this->find();

            if(!call_user_func_array(array($controller, $action), $params)) {
                header("HTTP/1.0 404 Not Found");
                die;
            }

        }catch (\Exception $e) {

        }
    }

    public function find() : array
    {
        foreach($this->routes as $route => $dest)
        {

            $uri = $this->getUri();
            preg_match("~^".$route."$~", $uri, $matches);
            if(count($matches) > 0) {

                //Оставляем только найденные аргументы
                array_shift($matches);
                list($controller, $action) = $this->getDestination($dest);
                $route = array($controller, $action, $matches);

                return $route;
            }

        }
        return array('nofound', 'index', array(
            'uri' => $uri
        ));

    }

    protected function getController(string $name) : string
    {
        return ucfirst($name).'Controller';
    }

    protected function getAction(string $action) : string
    {
        return $action.'Action';
    }

    protected function getDestination(string $dest) : array
    {
        $dest = trim($dest, '/');
        $dest = explode('/', $dest);

        //$dest[0] = $this->getController($dest[0]);
        //$dest[1] = $this->getAction($dest[1]);

        return $dest;
    }

}
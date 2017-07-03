<?php


namespace MySimple\RestApp\Core\Abstracts;


abstract class AbstractRouter
{
    protected $routes;

    function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function run(){
        throw new \Exception('No implementation');
    }


/*
    protected function getParams(string $route) : array
    {
        preg_match('/\:[a-zA-Z]+/', $route, $matches);

        return $matches;
    }*/
    /*
    protected function clearRoute(string $route) : string
    {
        $cleaned = preg_replace('/\:[a-zA-Z]+/', '', $route);
        return $cleaned;
    }
    */
    protected function getUri() : string
    {
        return trim($_SERVER['REQUEST_URI'], '/');
    }
}
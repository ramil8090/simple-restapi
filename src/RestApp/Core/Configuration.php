<?php


namespace MySimple\RestApp\Core;


use MySimple\RestApp\Core\Abstracts\AbstractConfiguration;
use Vespula\Log\Exception;


class Configuration extends AbstractConfiguration
{
    protected $routes;
    protected $acl;
    protected $db;

    protected function parse()
    {
        $this->routes = $this->config[APP_ENVIRONMENT]['routes'];
        $this->acl = $this->config[APP_ENVIRONMENT]['acl'];
        $this->db = $this->config[APP_ENVIRONMENT]['db'];
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getAcl($entity)
    {
        if(false === in_array($entity, array_keys($this->acl))) {
            throw new Exception('No found entity '.$entity.' in access control list', 500);
        }

        return $this->acl[$entity];
    }

    public function getDb()
    {
        return $this->db;
    }

}
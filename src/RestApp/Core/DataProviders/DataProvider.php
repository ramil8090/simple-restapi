<?php


namespace MySimple\RestApp\Core\DataProviders;


use \Slim\PDO\Database;


class DataProvider
{
    protected $db;
    protected $model;
    protected $params;
    protected $statement;
    protected $orderBy='id ASC';
    protected $groupBy='';
    protected $limit=30;
    protected $offset=0;


    function __construct(Database $db, string $model, array $params)
    {
        $this->db = $db;
        $this->model = $model;
        $this->params = $params;
        $this->init();
    }

    protected function init()
    {

        if(isset($this->params['statement'])) {
            $this->statement = $this->params['statement'];
        } else {
            $this->statement = $this->db->select()->from(($this->model)::table());
        }

        if(isset($this->params['groupBy'])) {
            $this->groupBy = $this->params['groupBy'];
        }

        if(isset($this->params['orderBy']) && (bool)$this->params['orderBy']) {
            $this->orderBy = $this->params['orderBy'];
        }

        if(isset($this->params['perPage'])) {
            $this->limit = abs($this->params['perPage']);
        }

        if(isset($this->params['page'])) {
            $this->offset = (integer)(abs($this->params['page']-1) * $this->limit);
        }
    }

    public function fetchAll()
    {
        if(true == $this->groupBy) {
            $this->statement = $this->statement->groupBy($this->groupBy);
        }

        preg_match('/^([a-z0-9A-Z\_]+,? ?([a-z0-9A-Z\_]+,? ?)?) ([a-zA-Z]{3,4})$/', $this->orderBy, $matches);
        if($matches) {
            //var_dump($matches);die;
            $this->statement = $this->statement->orderBy($matches[1], $matches[3]);
        }

        $this->statement = $this->statement->limit($this->limit, $this->offset);
        //var_dump($this->statement->execute());die;
        $data = $this->statement->execute()->fetchAll();
        return $data;
    }



}
<?php

namespace MySimple\RestApp\Core\Interfaces;


interface ExecuterInterface {
    public function exec($controller, $action, $params);
}


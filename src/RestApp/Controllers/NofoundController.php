<?php
/**
 * Created by PhpStorm.
 * User: hubble
 * Date: 7/1/17
 * Time: 11:01 PM
 */

namespace MySimple\RestApp\Controllers;


use MySimple\RestApp\Core\Controllers\Controller;
use MySimple\RestApp\Views\View;

class NofoundController extends Controller
{
    public function indexAction($uri)
    {
        $error = array(
            'Code' => '404',
            'Status' => 'Not found',
            'Message' => 'Not found route: '.$uri
        );

        $view = new View( $this->getRenderType() );
        return $view->render($error);
    }
}
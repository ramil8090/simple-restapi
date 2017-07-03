<?php


namespace MySimple\RestApp\Core\Controllers;

use MySimple\RestApp\Core\Abstracts\AbstractController;
use MySimple\RestApp\Core\ApplicationContext;
use MySimple\RestApp\Views\JsonRender;
use MySimple\RestApp\Views\RenderInterface;
use MySimple\RestApp\Views\View;
use MySimple\RestApp\Views\XmlRender;


class Controller extends AbstractController
{
    protected $context;

    function __construct(ApplicationContext $context)
    {
        $this->context = $context;
    }

    protected function getRenderType() : RenderInterface
    {
        $contentType = View::TYPE_JSON;

        if(isset($this->context->request->getHeader('Content-Type')[0])){
            $contentType = $this->context->request->getHeader('Content-Type')[0];
        }

        if($contentType != View::TYPE_JSON) {
            $contentType = new XmlRender();
        } else {
            $contentType = new JsonRender();
        }

        return $contentType;
    }

}
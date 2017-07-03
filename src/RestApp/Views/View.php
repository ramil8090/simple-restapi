<?php


namespace MySimple\RestApp\Views;


class View
{
    const TYPE_JSON = 'application/json';
    const TYPE_XML = 'application/xml';

    protected $renderType;

    function __construct(RenderInterface $renderType)
    {
        $this->renderType = $renderType;
    }

    public function render($data){
        
        if(!$this->renderType) {
            throw new \Exception('Render not set', 500);
        }
        
        return $this->renderType->render($data);
    }
}

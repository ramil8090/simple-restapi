<?php


namespace MySimple\RestApp\Core\ChainHandlers;


use MySimple\RestApp\Core\Interfaces\HandlerInterface;


class HandlersContainer implements HandlerInterface
{
    protected $handlers;

    public function addHandler(HandlerInterface $handler)
    {
        $this->handlers = $handler;
    }

    public function process($data)
    {
        try
        {
            foreach($this->handlers as $handler) {

                $handler->process($data);

            }
        } catch(\Exception $e)
        {
            return false;
        }

    }
}
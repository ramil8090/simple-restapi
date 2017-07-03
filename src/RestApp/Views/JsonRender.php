<?php


namespace MySimple\RestApp\Views;


class JsonRender implements RenderInterface{
    
    public function render(array $data) {
        
        $json = json_encode($data);
        
        if ($json == null) {
            return json_encode(array(
                'error' => 'render to json'
            ));
        }
        
        return $json;
    }
}

<?php

namespace MySimple\RestApp\Views;

class XmlRender implements RenderInterface
{
    public function render(array $data) {

        $xml_user_info = new \SimpleXMLElement("<?xml version=\"1.0\"?><response></response>");
        $this->array_to_xml($data, $xml_user_info);
        $xml = $xml_user_info->asXML();
        
        if ($xml) {
            return $xml;
        } else {
            die('XML file generation error.');
        }
    }
    
    private function array_to_xml($array, &$xml_user_info) {
        foreach($array as $key => $value) {
            if(is_array($value)) {
                if(!is_numeric($key)){
                    $subnode = $xml_user_info->addChild("$key");
                    $this->array_to_xml($value, $subnode);
                }else{
                    $subnode = $xml_user_info->addChild("item");
                    $this->array_to_xml($value, $subnode);
                }
            }else {
                $xml_user_info->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }
}


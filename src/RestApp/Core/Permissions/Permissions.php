<?php


namespace MySimple\RestApp\Core\Permissions;


use MySimple\RestApp\Core\Abstracts\AbstractPermissions;


class Permissions extends AbstractPermissions{
    
    /**
     * @example 
     * $rules = array(
     *     'guest' => array('index','view'),
     *     'user' => array('save', 'delete')
     * )
     */
    public function hasPermissions($entity, $action, $role) {
        
        if(count($this->rules) == 0) {
            return false;
        }

        if(false === in_array($role, array_keys($this->rules))) {
            return false;
        }

        $rules = array_map('trim', explode(',', $this->rules[$role]));
        if(false === in_array($action, $rules)) {
            return false;
        }
        
        return true;
    }
}

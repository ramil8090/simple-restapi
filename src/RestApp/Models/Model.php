<?php


namespace MySimple\RestApp\Models;


use MySimple\RestApp\Core\Abstracts\AbstractModel;


class Model extends AbstractModel
{
    const OPERATOR_EQUAL='equal';
    const OPERATOR_NOTEQUAL='notequal';
    const OPERATOR_LIKE='like';
    const OPERATOR_NOTLIKE='notlike';

    public static function table()
    {
        return 'table';
    }

    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $attribute=>$value)
        {
            $this->$attribute = $value;
        }
    }

    public static function attributes()
    {
        return array();
    }

    public function toArray(): array
    {
        $data = array();
        foreach ($this::attributes() as $attribute) {
            $data[$attribute] = $this->$attribute;
        }
        return $data;
    }
}
<?php


namespace MySimple\RestApp\Models;


use MySimple\RestApp\Core\DataProviders\DataProvider;


class ObjectModel extends Model
{
    public $id;
    public $room_id;
    public $survey_id;
    public $host_id;
    public $room_type;
    public $country;
    public $city;
    public $borough;
    public $neighborhood;
    public $reviews;
    public $overall_satisfaction;
    public $accommodates;
    public $bedrooms;
    public $bathrooms;
    public $price;
    public $minstay;
    public $last_modified;
    public $latitude;
    public $longitude;
    public $location;

    public static function table()
    {
        return 'objects';
    }

    public static function attributes()
    {
        return array(
            'id',
            'room_id',
            'survey_id',
            'host_id',
            'room_type',
            'country',
            'city',
            'borough',
            'neighborhood',
            'reviews',
            'overall_satisfaction',
            'accommodates',
            'bedrooms',
            'bathrooms',
            'price',
            'minstay',
            'last_modified',
            'latitude',
            'longitude',
            'location'
        );
    }

    public function findById($id)
    {
        $query = $this->db->select()
                            ->from(self::table())
                            ->where('id', '=', $id)
                            ->limit(1,0);
        $stmt = $query->execute();
        $data = $stmt->fetch();

        if (!$data) {
            return false;
        }

        $this->setAttributes((array)$data);
        return $this;
    }

    public function findAll($page, $perPage)
    {
        $query = $this->db->select()
            ->from(self::table())
            ->where('id', '>', 'asa');

        $provider = new DataProvider($this->db, self::class, array(
            'page'=>$page,
            'perPage'=>$perPage,
            'statement'=>$query
        ));

        return $provider->fetchAll();
    }

    public function findByParam($param, $operator, $value, $page=1, $perPage=30, $orderBy='')
    {
        $operators = array(
            self::OPERATOR_EQUAL => '=',
            self::OPERATOR_NOTEQUAL => '<>',
            self::OPERATOR_LIKE => 'LIKE',
            self::OPERATOR_NOTLIKE => 'NOT LIKE'
        );

        if(false === isset($operators[$operator]) ||
            false === in_array($param, array_keys(get_class_vars(self::class)))) {
            return array();
        }

        if($orderBy == true) {
            preg_match('/^(\-)?([a-zA-Z0-9\_]+)$/', $orderBy, $matches);
            $orderBy = $matches[1] == true ? $matches[2].' ASC' : $matches[2].' DESC';
        }

        $query = $this->db->select()
            ->from(self::table());

        if(in_array($operator, array(self::OPERATOR_LIKE, self::OPERATOR_NOTLIKE))){
            $query = $query->whereLike($param, '%'.$value.'%');
        } else {
            $query = $query->where($param, $operators[$operator], $value);
        }


        $provider = new DataProvider($this->db, self::class, array(
            'page' => $page,
            'perPage' => $perPage,
            'orderBy' => $orderBy,
            'statement' => $query
        ));

        return $provider->fetchAll();
    }

    public function save()
    {
        list(
            $columns,
            $values
            ) = $this->prepareData();

        unset($columns[0]);
        unset($values[0]);
        $insertStatement = $this->db->insert(array('id'=>null))
                                    ->columns($columns)
                                    ->into(self::table())
                                    ->values($values);

        ///var_dump($insertStatement);die;
        return $insertStatement->execute(true);
    }

    public function update()
    {
        list(
            $columns,
            $values
            ) = $this->prepareData();

        $data = array_combine($columns, $values);
        $updateStatement = $this->db->update(array())
            ->set($data)
            ->table(self::table())
            ->where('id', '=', $data['id']);

        return $updateStatement->execute();
    }

    public function delete()
    {
        $deleteStatement = $this->db->delete()
            ->from(self::table())
            ->where('id', '=', $this->id);

        return $deleteStatement->execute();
    }

    private function prepareData()
    {
        $columns = self::attributes();
        $values = array();

        foreach ($columns as $column) {
            //var_dump($column);die;
            $values[] = $this->$column;
        }

        return array($columns, $values);
    }


}
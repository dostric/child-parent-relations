<?php




class SearchSettings {

    public $id;             // object id
    public $idList;         // objects id list
    public $name;           // object name
    public $type;           // object type
    public $group;          // object group
    public $channel;        // object channel

    public $dateFrom;       // search arrival date
    public $dateTo;         // search departure date

    public $unitId;         // object item id
    public $unitIdList;     // object items id list


    public function __construct($data = array()) {

        if (is_array($data) && count($data)) {
            foreach($data as $key => $val) {
                $this->set($key, $val);
            }
        }

    }


    public static function factory($data = array()) {
        return new static($data);
    }


    public function set($name, $value) {
        if (property_exists($this, $name)) {
            $this->{$name} = $value;
        }
        return $this;
    }


    public function toArray() {
        return get_class_vars(get_class($this));
    }


    /**
     * Generates new search criteria based on defined properties.
     *
     * @param string|array $propertiesFrom
     * @param SearchSettings|array $data
     *
     * @return SearchSettings
     */
    public function newFrom($propertiesFrom, $data) {

        if (!is_array($propertiesFrom)) {
            $propertiesFrom = explide(',', $propertiesFrom);
        }

        if ($data instanceof SearchSettings) {
            $data = $data->toArray();
        }

        $ss = new self;
        foreach($propertiesFrom as $key) {
            $ss->set($key, array_key_exists($key, $data) ? $data[$key] : null);
        }

        return $ss;
    }


}






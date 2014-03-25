<?php



class DescriptionItem {


    protected $parent;


    protected $model;


    protected $values;



    public function __construct($parent = null, $model = null, $values = null) {

        if ($parent) {
            $this->parent = $parent;
        }

        if ($model instanceof DescriptionItem_Model) {
            $this->model = $model;
        }

        if (is_array($values)) {
            $this->values($values);
        }

    }


    public static function make($parent = null, $model = null, $values = null) {
        return new static($parent, $model, $values);
    }


    public function load($ss) {

        return $this;
    }


    public function model($key = null) {
        return $key === null ? $this->model : $this->model->{$key};
    }


    public function values($values = null) {

        // init the value controller and set the values if available
        if (!$this->values || $values !== null) {

            $this->values = DescriptionValueController::make($this, $values);
            if ($values === null) {
                $this->values->load();
            }

        }

        return $this->values;
    }

}


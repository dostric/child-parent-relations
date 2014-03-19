<?php



class DescriptionFrom implements ControllerInterface {


    /**
     * @var DescriptionForm_Model
     */
    protected $model;


    /**
     * @var DescriptionItemController[]
     */
    protected $items;


    public function __construct() {

        $this->forms = array();

    }


    public static function make() {

    }


    public function model($key = null) {
        return $key === null ? $this->model : $this->model->{$key};
    }


    public function getId() {

    }


    public function load($ss, $ls) {

    }




}
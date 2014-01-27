<?php


class DescriptionController {


    protected $items;


    public function __construct() {

        $this->items = array();

    }


    public static function make() {
        return new static();
    }


    public function load() {}


    public function all() {
        return $this->items;
    }


    public function has($description) {
        return true;
    }


    public function get($description, $default = null) {
        return $this->has($description) ? $this->items[$description] : $default;
    }

}








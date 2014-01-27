<?php


class AvailabilityController {

    protected $object;


    /**
     * @var AvailabilityItem[]
     */
    protected $periods;


    public function __construct($object = null) {

        $this->object = $object;

    }


    public static function make($object = null) {
        return new static($object);
    }


    public function load() {

        return $this;
    }


    public function all() {
        return $this->periods;
    }


    /**
     * @return AvailabilityItem[]
     */
    public function filter() {

        // iterate through availability periods and find matching items

        return array();

    }


}




class AvailabilityItem {


}
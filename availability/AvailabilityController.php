<?php


class AvailabilityController implements ControllerInterface {

    protected $object;


    /**
     * @var AvailabilityItem[]
     */
    protected $periods;


    protected $found;


    public function __construct($object = null) {

        $this->object = $object;

    }


    public static function make($object = null) {
        return new static($object);
    }


    /**
     * Load previously found availability periods.
     *
     * @param $ls
     * @return $this
     */
    public function load($ls) {
        return $this;
    }


    public function get($id) {

    }


    public function all() {
        return $this->periods;
    }


    public function has($id) {
        return array_key_exists($id, $this->periods);
    }

    public function getList() {
        return $this->found;
    }


    public function count() {
        return count($this->periods);
    }


    public function add($item) {

    }


    public function remove($id) {

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


    public function __construct() {

    }


    public static function make() {
        return new static();
    }

}
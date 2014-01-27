<?php


class PriceList {


    protected $object;


    /**
     * @var PriceListItem[]
     */
    protected $items;


    public function __construct($object = null) {

        $this->items = array();

        $this->object = $object;

    }

    public static function make($object = null) {
        return new static($object);
    }


    public function load($ss = null) {

        // load the price list based on search settings or load the object if it is available and settings are not provided.
        $this->items[] = new PriceListItem();

        return $this;

    }


    /**
     * @return int
     */
    public function count() {
        return count($this->items);
    }


    /**
     * @return PriceListItem[]
     */
    public function all() {
        return $this->items;
    }


    /**
     * @return PriceListItem[]
     */
    public function filter() {

        // filter and return matching price list items

        return array();

    }


}

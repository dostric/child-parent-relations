<?php

/**
 * Class PriceListController
 *
 * Handles multiple price lists functionality.
 *
 * @method PriceList get($key, $default = null)
 * @method PriceList[] all()
 */
class PriceListCollection extends CollectionBase implements ControllerSearchableInterface {


    protected $object;


    /**
     * @var PriceList
     */
    protected $priceLists;


    /**
     * @var PriceList_List
     */
    private $found;


    public function __construct($object = null) {

        $this->priceLists = new PriceList();

        $this->found = new PriceList_List();

        $this->object = $object;

    }


    public static function make($object = null) {
        return new static($object);
    }


    /**
     * @param array|SearchSettings $ss
     * @return $this
     */
    public function find($ss) {

        // we`ll search for matching price list and populate the found class

        return $this;

    }


    /**
     * @param null|array|SearchSettings $ls
     * @return $this
     */
    public function load($ls = null) {

        // if search settings are provided load the corresponding price list.
        // else if we have the object - load its price list.

        return $this;

    }


    public function getList() {
        return $this->found;
    }


}




class PriceList_List {

    public $total   = 0;
    public $idList  = array();

}
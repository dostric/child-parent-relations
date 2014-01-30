<?php

/**
 * Class PriceListController
 *
 * Handles multiple price lists functionality.
 *
 */
class PriceListController implements ParentControllerInterface {


    protected $object;


    /**
     * @var PriceList
     */
    protected $priceLists;


    /**
     * @var PriceList_List
     */
    private $found;


    public function __construct() {

        $this->priceLists = new PriceList();

        $this->found = new PriceList_List();

    }


    public static function make() {
        return new static();
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
     * @param null|array|SearchSettings $ss
     * @return $this
     */
    public function load($ss = null) {

        // if search settings are provided load the corresponding price list.
        // else if we have the object - load its price list.

        return $this;

    }


    /**
     * @return PriceListItem[]
     */
    public function filter() {
        // filter price list items
        return array();
    }


    /**
     * @param int $id
     * @return PriceList|null
     */
    public function get($id) {
        return array_key_exists($id, $this->priceLists) ? $this->priceLists[$id] : null;
    }


    public function getList() {
        return $this->found;
    }


}




class PriceList_List {

    public $total   = 0;
    public $idList  = array();

}
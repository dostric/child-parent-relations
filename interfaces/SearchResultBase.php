<?php


class SearchResultBase {


    /**
     * Total of items found
     * @var int
     */
    public $total = 0;

    /**
     * items id list
     * @var array
     */
    public $idList = array();

    /**
     * Cached items data. Used to avoid double loading.
     * @var array
     */
    public $data = array();


    public function toArray() {
        return get_object_vars($this);
    }


}
<?php


/**
 * Object controller handles multiple object instances.
 *
 * Class Object
 *
 */
class ObjectController {


    /**
     * @var SearchSettings
     */
    protected $ss;

    /**
     * @var LoadSettings
     */
    protected $ls;


    /**
     * @var Object[]
     */
    protected $objects;


    /**
     * The search result data.
     * The data should be private to avoid wrong loading. We must use class methods to search for objects.
     *
     * @var Object_List
     */
    private $found;



    public function __construct(SearchSettings $ss = null, LoadSettings $ls = null) {

        $this->ss = $ss;

        $this->ls = $ls;

        $this->found = new Object_List();

    }


    public static function make(SearchSettings $ss = null, LoadSettings $ls = null) {
        return new static($ss, $ls);
    }


    /**
     *
     * @param SearchSettings|array $ss
     *
     * @return self
     */
    public function find($ss = null) {

        /*
         * Class for searching for objects.
         *
         * 1. first we need to parse the data and check for valid data.
         * 2. reset the found class
         * 3. perform the search query; iterate through results and
         *
         */

        // reset the object list
        $this->found->idList = array();

        try {

            // perform the query
            // usually this is a complex query.
            // the query deals with various search data like (dates, types, destination, ...)

            // dummy query results
            $searchResult = array(
                (object)array(
                    'id' => 1,
                    'name'  => 'Object 1'
                ),
                (object)array(
                    'id' => 2,
                    'name'  => 'Object 2'
                ),
            );

            foreach($searchResult as $item) {

                // store the data in the found class
                $this->found->idList[] = $item->id;     //
                $this->found->data[$item->id] = $item;  // store the data if we do not need any more data (avoid double loading the base object data)

            }

            // represents the find query total records.
            // usually we`ll use pagination - the result set count is not the total found count.
            $this->found->total = 500;

        } catch(\Exception $e) {

            $this->found = new Object_List();

        }

        // we`ll need chaining
        return $this;

    }


    public function load(LoadSettings $ls = null) {

        // check if we found some objects in the search process.
        if ($this->found && $this->found->total) {

            // iterate through the found object id list and load the objects.
            foreach($this->found->idList as $id) {

                $this->objects[$id] = Object::make($id, $ls ? $ls : $this->ls);

            }

        }

        return $this;

    }


    /**
     * @param $id
     * @return null|Object
     */
    public function get($id) {
        return array_key_exists($id, $this->objects) ? $this->objects[$id] : null;
    }


    /**
     * @return Object[]
     */
    public function all() {
        return $this->objects;
    }


    public function getList() {
        return $this->found;
    }

}


/**
 * Simple class that stores the object search results.
 *
 * Class Object_List
 *
 */
class Object_List {

    /**
     * Total of objects found.
     * @var int
     */
    public $total = 0;

    /**
     * Found object id list array.
     * @var array
     */
    public $idList = array();

    /**
     * Property holds the cached object data.
     * If we do not need extra object data - then all the data is already loaded by the search.
     * In that case we can use this data to avoid double loading.
     *
     * @var array
     */
    public $data = array();


    public function toArray() {
        return get_object_vars($this);
    }


}
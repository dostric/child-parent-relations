<?php


/**
 * Object controller handles multiple object instances.
 *
 * Class Object
 *
 *
 * @method Object get($id, $default = null)
 * @method Object[] all()
 *
 *
 */
class ObjectCollection extends CollectionBase implements ControllerSearchableInterface {


    /**
     * @var SearchSettings
     */
    protected $ss;


    /**
     * Holds the last search result data.
     *
     * @var Object_List
     */
    private $found;



    public function __construct(SearchSettings $ss = null) {

        $this->ss = $ss;

        $this->found = new Object_List();

        if ($this->ss) {

            $this
                ->find($this->ss)
                ->load();

        }

    }


    public static function make(SearchSettings $ss = null) {
        return new static($ss);
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


    public function load() {

        // check if we found some objects in the search process.
        if ($this->found && $this->found->total) {

            // iterate through the found object id list and load the objects.
            foreach($this->found->idList as $id) {

                $this->add(Object::make($id));

            }

        }

        return $this;

    }


    /**
     * @return Object_List
     */
    public function getList() {
        return $this->found;
    }








}


/**
 * Object search results.
 *
 * Class Object_List
 *
 */
class Object_List extends SearchResultBase {

}
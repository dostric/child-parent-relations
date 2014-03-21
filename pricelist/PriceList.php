<?php



class PriceList implements ControllerInterface {


    protected $object;


    protected $id;


    protected $model;


    /**
     * @var PriceListItem_Model[]
     */
    protected $items;





    public function __construct($object = null, $ss = null) {

        $this->id = null;

        $this->model = new PriceList_Model();

        $this->items = array();

        $this->object = $object;

        if ($ss) {
            $this->load($ss);
        }

    }


    public static function make($object = null) {
        return new static($object);
    }


    public function load($ss = null) {


        // load the price list based on search settings or load the object if it is available and settings are not provided.
        // 1 load current pricelist data - usually it is a model
        $this->model = new PriceList_Model();


        // 2 load price list items
        $this->items[] = new PriceListItem_Model();


        return $this;


    }


    public function model($key = null) {


    }


    public function getId() {
        return $this->id;
    }


}



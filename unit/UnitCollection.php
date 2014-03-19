<?php



class UnitCollection extends CollectionBase implements  ControllerSearchableInterface {


    protected $ss;


    protected $ls;


    /**
     * Items parent.
     *
     * @var Object
     */
    protected $object;


    /**
     * Array of product items.
     *
     * @var Unit[]
     */
    protected $units;


    /**
     * @var Unit_List
     */
    private $found;


    public function __construct($object = null, $ss = null, $ls = null) {

        // if we have the relation to the object store it.
        // the relation is optional in the case we are loading some arbitrary units.
        $this->object = $object;

        $this->units = array();

        $this->found = new Unit_List();

        // detect the search data
        // we cal load object units (search key will be the object id, or some other arbitrary data - then we are loading custom units)
        if ($ss instanceof SearchSettings) {

            $this->ss = $ss;

            // if we do not have the load settings prevent items auto loading.
            if ($ls) $this->load($ss, $ls);

        }

    }


    public static function make($object = null, $ss = null, $ls = null) {
        return new static($object, $ss, $ls);
    }


    public function getObject() {
        return $this->object instanceof Object ? $this->object : null;
    }


    public function find($ss) {
        // search for units based on input params

        // reset the found data
        $this->found = new Unit_List();

        // find the units
        $unitDummyList = array(
            (object)array(
                'id'        => '100',       // unit id
                'unitName'  => 'Room 1'
            ),
            (object)array(
                'id'        => '200',
                'unitName'  => 'Room 2'
            )
        );

        $this->found->total = count($unitDummyList); // example

        foreach($unitDummyList as $unit) {

            $this->found->idList[] = $unit;
            $this->found->data[$unit->getId()] = $unit; // cache the model data

        }

        return $this;

    }


    public function load($ss = null, $ls = null) {

        // perform the unit serach query based on search settings.
        // iterate through results and load units.

        $unitDummyList = array(
            (object)array(
                'id'        => '100',       // unit id
                'unitName'  => 'Room 1'
            ),
            (object)array(
                'id'        => '200',
                'unitName'  => 'Room 2'
            )
        );

        try {

            foreach($unitDummyList as $item) {

                // add the unit to the units list
                // pass the unit data loading to the unit class
                // save the unit to unit controller relation - pass the reference $this
                // if we found the unit we have its id - we`ll use unit loading by id
                // we need load settings to know what additionally to load for the unit
                $this->add(new Unit($this, $item->id, $ls));

            }

        } catch(\Exception $e) {

            $this->units = array();

        }

        return $this;

    }


    /**
     * @return Unit_List
     */
    public function getList() {
        return $this->found;
    }


    public function getPriceList() {

        $pl = array();

        if ($this->object) {

            // we`ll filter the object price list to get the unit items.
            $pl = $this->object->priceList()->filter(function($item) {

                if ($item->unitId) return true;

                return false;

            });

        }

        return $pl;

    }


    public function getAvailability() {

        $availability = array();

        if ($this->object) {

            // filter unit availability periods
            $availability = $this->object->availability()->filter(function($item) {

            });

        }

        return $availability;

    }


    /**
     * @param SearchSettings $ss
     * @return bool
     */
    public function isAvailable($ss) {

        // iterate through the availability periods and check if the unit is available

        if ($ss->dateFrom && $ss->dateTo && count($periods = $this->getAvailability())) {

            try {

                $dateFrom = new datetime($ss->dateFrom);
                $dateTo = new datetime($ss->dateTo);

            } catch(\Exception $e) {
                return false;
            }
            foreach($this->getAvailability() as $period) {

                // check the

            }

        }

        return true;

    }


}


class Unit_List {

    public $total;
    public $idList;
    public $data;

}
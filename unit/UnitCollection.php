<?php


/**
 * Class UnitCollection
 *
 * @method Unit get($id, $default = null)
 * @method Unit[] all()
 *
 */
class UnitCollection extends CollectionBase implements  ControllerSearchableInterface {


    protected $ss;


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


    public function __construct($object = null, $ss = null) {

        // defaults
        $this->units = array();

        $this->found = new Unit_List();

        $this->ss = $ss instanceof SearchSettings ?: null;

        // the relation to the object is optional for the case we are loading some arbitrary units.
        $this->object = $object instanceof Object ?: null;

        /*
        // if we have some input we can auto load the units
        if ($object || $this->ss) {

            $this->load($this->ss);

        }
        */

    }


    public static function make($object = null, $ss = null) {
        return new static($object, $ss);
    }


    /**
     * @return null|Object
     */
    public function object() {
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
            $this->found->data[$unit->id] = $unit; // cache the model data

        }

        return $this;

    }


    public function load($ss = null) {

        // perform the unit search query based on search settings.
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
                $this->add(new Unit($this, $item->id));

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


    public function priceList() {

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


    public function availability() {

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

        if ($ss->dateFrom && $ss->dateTo && $this->availability()->count()) {

            try {

                $dateFrom = new datetime($ss->dateFrom);
                $dateTo = new datetime($ss->dateTo);

            } catch(\Exception $e) {
                return false;
            }

            foreach($this->availability()->all() as $period) {

                // check the

            }

        }

        return true;

    }


}


class Unit_List extends SearchResultBase {

}
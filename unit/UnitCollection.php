<?php


/**
 * Class UnitCollection
 *
 * @method Unit get($id, $default = null)
 * @method Unit[] all()
 *
 */
class UnitCollection extends CollectionBase implements  ControllerSearchableInterface {


    /**
     * @var SearchSettings
     */
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


    public function __construct($object = null) {

        // defaults
        $this->reset();

        // the relation to the object is optional for the case we are loading some arbitrary units.
        $this->object = $object instanceof Object ?: null;

    }


    public static function make($object = null) {
        return new static($object);
    }


    /**
     * @return null|Object
     */
    public function object() {
        return $this->object instanceof Object ? $this->object : null;
    }


    /**
     *
     */
    private function reset() {

        $this->units = array();
        $this->found = new Unit_List();

    }


    public function find($ss) {

        // reset the found data
        $this->reset();

        // detect search
        if (is_array($ss)) {
            $ss = SearchSettings::factory($ss);
        } elseif ($ss instanceof Object) {
            $ss = SearchSettings::factory([
                'id' => $ss->getId()
            ]);
        }

        // search for units based on input params
        $this->ss = $ss instanceof SearchSettings ?: null;

        if ($this->ss) {

            if ($ss->id) {
                // load object units
            }

            // find the units and get the result
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

        }

        return $this;

    }


    /**
     * Loads units defined by settings if provided
     *      else loads the parent obect units if parent exists (this->object)
     * @param SearchSettings|null $ss
     * @return $this
     */
    public function load($ss = null) {

        // set defaults
        $this->reset();

        // perform the unit search query based on search settings.
        if (is_array($ss)) {

            $ss = SearchSettings::factory($ss);

        } elseif ($this->object instanceof Object) {

            $ss = SearchSettings::factory([
                'id' => $this->object->getId()
            ]);

        }

        if ($ss instanceof SearchSettings && $ss->id) {

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
                    $this->add(new Unit($this, $item->id));

                }

            } catch(\Exception $e) {

                // reset
                $this->reset();

                // log the error & if debug mode display the error

            }

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


    public function availableUnits(SearchSettings $ss) {

        $availableUnits = $this->all();

        if ($ss->dateFrom && $ss->dateTo) {

            if ($availability = $this->object()->availability()) {

                // filter $availableUnits units

            }

        }

        return $availableUnits;

    }


    public function unAvailableUnits(SearchSettings $ss) {

        $unaAvailableUnits = array();
        $allUnits = $this->all();
        $availableUnits = $this->availableUnits($ss);

        foreach($allUnits as $unit) {
            // if unit is not in availableUnits = the unit is not available
        }

        return $unaAvailableUnits;

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
    public function isFree($ss) {

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
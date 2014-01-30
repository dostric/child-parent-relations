<?php



class Unit {


    /**
     * @var UnitController
     */
    protected $parent;

    protected $id;

    protected $data;


    /**
     * @param null $parent
     * @param null|int|SearchSettings $ss
     * @param null|LoadSettings $ls
     */
    public function __construct($parent = null, $ss = null, $ls = null) {

        if ($parent && $parent instanceof UnitController) {
            $this->parent = $parent;
        }

        if ($ss) $this->load($ss, $ls);

    }


    public static function make($parent = null, $ss = null, $ls = null) {
        return new static($parent, $ss, $ls);
    }


    /**
     * Loads one unit data.
     *
     * @param int|array|SearchSettings $ss
     * @param LoadSettings $ls
     * @return $this
     */
    public function load($ss, $ls = null) {

        // determine if we have something valid to load.
        // a good approach is to support multiple search params for loading.
        // the easiest one is the unit id, but there can be more

        // check
        if ($ss->unitId) {

            $dummyUnitData = new stdClass();
            $dummyUnitData->id = 100;
            $dummyUnitData->name = 'Room 1';

            if ($dummyUnitData && $dummyUnitData->id == $ss->unitId) {

                // store the base unit data
                $this->data = $dummyUnitData;
                $this->id = $dummyUnitData->id;

                // do we have something else to load
                if ($ls) {

                    // if we need unit images load them
                    if ($ls->unitImages) $this->loadImages();

                }

            } else {

                $this->id = $this->data = null;

            }

        }

        return $this;

    }


    public function isLoaded() {
        // check if the id
        return true;
    }


    public function loadImages() {
        // perform image loading
    }


    public function loadSomethingElse() {
        // we usually have something else to load.
    }


    /**
     * Simple method to return current unit data.
     * For a specific key we are returning it value - else we are returning all the values.
     *
     * @param null $somethingSpecific
     * @return mixed
     */
    public function getUnitData($somethingSpecific = null) {
        return $somethingSpecific === null ? $this->data : $this->data->{$somethingSpecific};
    }


    public function getObject() {
        return $this->parent instanceof UnitController ? $this->parent->getObject() : null;
    }


    public function getPriceList() {

        $pl = array();

        if ($object = $this->getObject()) {

            $pl = $object->priceList()->filter(/* unit filtering data*/);

        }

        return $pl;

    }


    public function getId() {
        return $this->isLoaded() ? $this->data->id : null;
    }
}

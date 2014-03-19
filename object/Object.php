<?php



/**
 * Class handles one object features.
 *
 * Uses search settings class (if provided) to determine what to search.
 * Uses load settings class (if provided) to determine what entities to laod.
 *
 */
class Object implements ControllerInterface {


    /**
     * @var int
     */
    protected $id;          // object id


    /**
     * @var Object_Model
     */
    protected $model;        // usually represents the main object data - the model.


    /**
     * @var UnitCollection
     */
    protected $units;           // contains the child items (units).


    /**
     * @var DescriptionCollection
     */
    protected $descriptions;    // description controller - contains object descriptions


    /**
     * @var AvailabilityCollection
     */
    protected $availability;


    protected $priceList;



    /**
     * @param mixed $ss main input parameter - represents usually the id or the settings class that defines what object to load.
     * @param mixed $ls the load settings class that determines what entities of the object to load.
     */
    public function __construct($ss = null, $ls = null) {

        $this->id = null;

        if ($ss) $this->load($ss, $ls);

    }


    /**
     * Makes the object supporting direct chaining.
     *
     * @param null $ss
     * @param null $ls
     * @return static
     */
    public static function make($ss = null, $ls = null) {
        return new static($ss, $ls);
    }


    /**
     * Loads the object based od various input data.
     * For ease of use we can support various inputs:
     *      - integer loads directly the object by primary key
     *      - search settings loads the object by provided params
     *      - array loads the object by provided data
     * Load settings defines what entities to load additionally.
     *
     * @param int|SearchSettings|array $ss
     * @param array|LoadSettings|null $ls
     *
     * @return self
     *
     */
    public function load($ss, $ls = null) {

        /**
         * 1. First we need to arse the search params to detect what object to load.
         * 2. If we have someting to laod try to load the object.
         * 3. If we successfully loaded the object determine if we need to load additional entities based on load settings.
         * 4. If needed load additional object entities.
         * 5. Check if need to load object children
         * 6. If we need to load object children
         *      - init the child controller and pass the object instance to have a reference to the parent object
         *      - pass the search and load settings to the unit controller
         *
         */

        /*
         * Step 1. - parse the input, determine what object to laod.
         *
         */

        /*
         * Step 2. - laod the object from database.
         * We`ll use the simplest dummy data container an stdClass object. It is good to us a framework model instead.
         *
         */
        $object = (object)array(
            'id'    => 100,
            'name'  => 'Object 1'
        );

        // some checking logic
        if ($object->id && $ss->id == $object->id) {

            // the loaded object id valid
            $this->model = new Object_Model($object);
            $this->id = $object->id;

            // do we have something else to load.
            if ($ls) {

                // load additional object entities.

                // load images
                if ($ls->objectImages) $this->loadImages($ss);

                // load availability
                if ($ls->availability) $this->loadAvailability($ss);

                // load price list
                if ($ls->priceList) $this->loadPriceList($ss);

                // do we need to load object units. if yes load them.
                if ($ls->units) {

                    if ($ls->unitImages) $this->loadUnits($ss, $ls);

                }

            }

        }

        return $this;

    }



    /**
     * Loads object children - the units.
     * Passes the search data to support various item loading.
     * Passes the load settings data to eventually load extra data on the units.
     *
     * @param $ss
     * @param $ls
     */
    public function loadUnits($ss, $ls) {

        // Usually we need to have the object loaded, but in some cases this is not needed.
        if ($this->isLoaded()) {

            // we are creating a collection of object units (the UnitController) and passing the task to load them to the controller.
            // we`ll provide the reference to the object - the units then can have access to each other.
            $this->units = UnitCollection::make($this, $ss, $ls);

        }

    }


    public function loadImages($ss) {
        // load object images.
    }


    public function loadPriceList($ss) {

        $this->priceList()->load($ss);

        return $this;

    }


    public function loadAvailability($ss) {

        $this->availability()->load($ss);

        return $this;

    }


    /**
     * @return bool
     */
    public function isLoaded() {
        // logic for determing if the object is loaded
        return true;
    }


    public function getId() {
        return $this->id;
    }


    public function model($key = null) {
        return $key === null ? $this->model : $this->model->{$key};
    }


    public function getType() {
        // return the object type
    }


    public function getGroup() {
        // return the object group
    }


    public function getSomething() {
        // we can have multiple similar methods that return some specific object data.
    }


    /**
     * The unit controller holds the array of object units (unit class).
     *
     * @return UnitCollection
     */
    public function units() {
        return $this->units instanceof UnitCollection ? $this->units : $this->units = new UnitCollection($this);
    }


    /**
     * @return DescriptionCollection
     */
    public function descriptions() {
        return $this->descriptions instanceof DescriptionCollection ? $this->descriptions : $this->descriptions = new DescriptionCollection($this);
    }


    /**
     * @return PriceListCollection
     */
    public function priceList() {
        return $this->priceList instanceof PriceList ? $this->priceList : $this->priceList = new PriceList($this);
    }


    /**
     * @return AvailabilityCollection
     */
    public function availability() {
        return $this->availability instanceof AvailabilityCollection ? $this->availability : $this->availability = new AvailabilityCollection($this);
    }


}


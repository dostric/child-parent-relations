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
     * @var ImageCollection
     */
    protected $images;


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
     */
    public function __construct($ss = null) {

        $this->id = null;

        if ($ss) $this->load($ss);

    }


    /**
     * Makes the object supporting direct chaining.
     *
     * @param null $ss
     * @return static
     */
    public static function make($ss = null) {
        return new static($ss);
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
     *
     * @return self
     *
     */
    public function load($ss) {

        /**
         * 1. First we need to parse the search params to detect what object to load.
         * 2. If we have something to load try to load the object.
         * 3. If we successfully loaded the object determine if we need to load additional entities based on load settings.
         * 4. If needed load additional object entities.
         * 5. Check if need to load object children
         * 6. If we need to load object children
         *      - init the child controller and pass the object instance to have a reference to the parent object
         *      - pass the search and load settings to the unit controller
         *
         */






        /*
         * Parse the input, determine what object to laod.
         *
         */
        if ( !is_object($ss) && is_numeric($ss)) {
            $ss = SearchSettings::factory([
                'objectId' => $ss
            ]);
        } elseif (is_array($ss)) {
            $ss = SearchSettings::factory($ss);
        }


        if ($ss instanceof SearchSettings) {

            /*
             * Load the object from database.
             * We`ll use the simplest dummy data container an stdClass object.
             * It is good to us a framework model instead.
             *
             */
            $object = (object)array(
                'id'    => 100,
                'name'  => 'Object 1'
            );

            // the loaded object id valid
            $this->model = new Object_Model($object);
            $this->id = $object->id;

        }

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
        return $this->units ?: ($this->units = UnitCollection::make($this)->load());
    }


    /**
     * @return DescriptionCollection
     */
    public function descriptions() {
        return $this->descriptions ?: ($this->descriptions = DescriptionCollection::make($this)->load());
    }


    /**
     * @return PriceListCollection
     */
    public function priceList() {
        return $this->priceList ?: ($this->priceList = PriceList::make($this)->load());
    }


    /**
     * @return AvailabilityCollection
     */
    public function availability() {
        return $this->availability ?: ($this->availability = AvailabilityCollection::make($this)->load());
    }


    /**
     * @return ImageCollection
     */
    public function images() {
        return $this->images ?: ($this->images = ImageCollection::make($this)->load());
    }

}


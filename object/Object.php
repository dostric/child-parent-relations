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


    /**
     * @var PriceListCollection
     */
    protected $priceList;


    /**
     * @param integer|SearchSettings|array $ss usually id or the settings class that defines what object to load.
     * @param Object_Model $model
     */
    public function __construct($ss = null, Object_Model $model = null) {

        $this->model = null;

        if ($model && $model->id) {
            $this->model = $model;
        } else if ($ss) {
            $this->load($ss);
        }

    }


    /**
     * Makes the object supporting direct chaining.
     *
     * @param null $ss
     * @param Object_Model $model
     * @return static
     */
    public static function make($ss = null, Object_Model $model = null) {
        return new static($ss, $model);
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

        // reset the model
        $this->model = null;

        // parse the input, determine what object to laod.
        if ( !is_object($ss) && is_numeric($ss)) {
            $ss = SearchSettings::factory([
                'objectId' => $ss
            ]);
        } elseif (is_array($ss)) {
            $ss = SearchSettings::factory($ss);
        }

        // we can load by id or by unique set (country, name)
        if ($ss instanceof SearchSettings) {

            /*
             * Load the object model from database.
             * For test std class will be used.
             *
             */
            $object = (object)array(
                'id'    => 100,
                'name'  => 'Object 1'
            );

            // the loaded object id valid
            $this->model = new Object_Model($object);

        }

        return $this;

    }


    /**
     * @return bool
     */
    public function isLoaded() {
        return $this->model instanceof Object_Model && $this->model->id;
    }


    public function getId() {
        return $this->isLoaded() ? $this->model('id') : null;
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
        return $this->units ?: $this->units = UnitCollection::make($this)->load();
    }


    /**
     * @return DescriptionCollection
     */
    public function descriptions() {
        return $this->descriptions ?: $this->descriptions = DescriptionCollection::make($this)->load();
    }


    /**
     * @return PriceListCollection
     */
    public function priceList() {
        return $this->priceList ?: $this->priceList = PriceList::make($this)->load();
    }


    /**
     * @return AvailabilityCollection
     */
    public function availability() {
        return $this->availability ?: $this->availability = AvailabilityCollection::make($this)->load();
    }


    /**
     * @return ImageCollection
     */
    public function images() {
        return $this->images ?: $this->images = ImageCollection::make($this)->load();
    }

}


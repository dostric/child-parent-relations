<?php



class Unit implements ControllerInterface {


    /**
     * @var UnitCollection
     */
    protected $parent;


    protected $id;


    protected $model;


    protected $images;


    protected $descriptions;





    /**
     * @param null $parent
     * @param null|int|SearchSettings $ss
     */
    public function __construct($parent = null, $ss = null) {

        if ($parent instanceof UnitCollection) {
            $this->parent = $parent;
        }

        if ($ss) $this->load($ss);

    }


    public static function make($parent = null, $ss = null) {
        return new static($parent, $ss);
    }


    /**
     * Loads one unit data.
     *
     * @param int|array|SearchSettings $ss
     * @return $this
     */
    public function load($ss) {

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
                $this->model = $dummyUnitData;
                $this->id = $dummyUnitData->id;

            } else {

                $this->id = $this->model = null;

            }

        }

        return $this;

    }


    public function getId() {
        return $this->isLoaded() ? $this->model->id : null;
    }


    public function isLoaded() {
        // check if the id
        return true;
    }


    /**
     * @param null|string $key
     * @return mixed
     */
    public function model($key = null) {
        return $key === null ? $this->model : $this->model->{$key};
    }


    public function object() {
        return $this->parent instanceof UnitCollection ? $this->parent->object() : null;
    }


    /**
     * @return PriceListItem_Model[]
     */
    public function priceList() {

        $pl = array();

        if ($object = $this->object()) {

            $unitId = $this->getId();

            $pl = $object->priceList()->filter(function ($item) use ($unitId) {
                return $item->unitId == $unitId;
            });

        }

        return $pl;

    }


    public function images() {

        if (!$this->images) {

            $this->images = ImageCollection::make($this)->load();

        }

        return $this->images();

    }



}

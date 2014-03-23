<?php



class Unit implements ControllerInterface {


    /**
     * @var UnitCollection
     */
    protected $parent;


    /**
     * @var Unit_Model
     */
    protected $model;


    /**
     * @var ImageCollection
     */
    protected $images;


    /**
     * @var DescriptionFrom
     */
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

        $id = null;
        if (is_array($ss) && array_key_exists('unitId', $ss)) {

            $id = $ss['unitId'];

        } elseif ($ss instanceof SearchSettings) {

            $id = $ss->unitId;

        }

        // check integer value; if ok try to load id
        if (($id = (int)$id) && is_numeric($id) && $id > 0) {

            // load the unit form source
            // set the model data
            $this->model = new Unit_Model([
                'id' => $id
            ]);

        }

        return $this;

    }


    /**
     * @return null|int
     */
    public function getId() {
        return $this->isLoaded() ? $this->model->id : null;
    }


    /**
     * @return bool
     */
    public function isLoaded() {
        return $this->model instanceof Unit_Model && $this->model->id;
    }


    /**
     * @param null|string $key
     * @return mixed
     */
    public function model($key = null) {
        return $key === null ? $this->model : $this->model->{$key};
    }


    /**
     * @return null|Object
     */
    public function object() {
        return $this->parent instanceof UnitCollection ? $this->parent->object() : null;
    }


    /**
     * @return PriceListItem_Model[]
     */
    public function priceList() {

        $pl = array();

        if ($object = $this->object()) {

            if ($unitId = $this->getId()) {

                $pl = $object->priceList()->filter(function ($item) use ($unitId) {
                    return $item->unitId == $unitId;
                });

            }

        }

        return $pl;

    }


    /**
     * @return ImageCollection
     */
    public function images() {
        return $this->images ?: $this->images = ImageCollection::make($this)->load();
    }



}

<?php



/**
 * Class AvailabilityController
 *
 * @method AvailabilityPeriod_Model get($id, $default = null)
 * @method AvailabilityPeriod_Model[] all()
 *
 */
class AvailabilityCollection extends CollectionBase implements ControllerSearchableInterface {


    protected $object;


    protected $found;



    public function __construct($object = null) {

        $this->object = $object;

    }


    public static function make($object = null) {
        return new static($object);
    }


    public function find($ss = null) {

    }


    /**
     * Load previously found availability periods.
     *
     * @param $ls
     * @return $this
     */
    public function load($ls = null) {
        return $this;
    }


    public function getList() {
        return $this->found;
    }


}

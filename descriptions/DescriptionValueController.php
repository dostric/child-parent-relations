<?php


/**
 * Class DescriptionValueController
 *
 * @method DescriptionValue_Model get($id, $default = null)
 * @method DescriptionValue_Model[] all()
 *
 */
class DescriptionValueController extends CollectionBase implements ControllerSearchableInterface {


    protected $parent;


    protected $found;


    /**
     * @param DescriptionItem|null $parent
     * @param DescriptionValue_Model[] $values
     */
    public function __construct($parent = null, array $values = null) {

        $this->parent = $parent;

        if ($values) {
            parent::__construct($values);
        }

    }


    public static function make($parent = null, array $values = null) {
        return new static($parent, $values);
    }


    public function find($ss) {

        return $this;
    }


    public function load($ss = null) {

        // if we have the ss load this items
        // if we have the found list load the list

        return $this;

    }


    public function getList() {
        return $this->found;
    }


}



<?php

/**
 * Class DescriptionController
 *
 * @method DescriptionFrom get($id, $default=null)
 * @method DescriptionFrom[] all()
 *
 */
class DescriptionCollection extends CollectionBase implements ControllerSearchableInterface {


    protected $parent;

    protected $referenceType;

    protected $referenceId;



    /**
     *
     * @param Object|Unit|null $parent
     */
    public function __construct($parent) {

        $this->items = array();

        if ($parent) {

            $this->parent = $parent;

            $this->referenceType = self::getReferenceType($parent);

            $this->referenceId = $parent->getId();

        }

    }


    public static function make($parent) {
        return new static($parent);
    }


    public static function getReferenceType($source) {

        if ($source instanceof Object) {
            return 'object';
        } elseif ($source instanceof Unit) {
            return 'unit';
        }

        return null;

    }


    public function find($ss) {

    }


    public function load($ls) {

    }


    public function getList() {

    }


}








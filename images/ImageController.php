<?php


/**
 * Class ImageController
 *
 * @method Image_Model get($id, $default = null)
 * @method Image_Model[] all()
 *
 */
class ImageCollection extends CollectionBase implements ControllerSearchableInterface {


    protected $parent;


    /**
     * @var Image_Model[]
     */
    protected $images;


    public function __construct($parent = null) {

        $this->images = array();

        $this->parent = $parent;

    }


    public static function make($parent = null) {
        return new static($parent);
    }


    public function find($ss) {

    }


    public function load($ls) {

    }


    public function getList() {

    }


}


class Image_List {

    public $total       = 0;
    public $idList      = array();
    public $data        = array();

}
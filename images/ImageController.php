<?php


class ImageController implements ControllerInterface {


    protected $parent;


    /**
     * @var Image[]
     */
    protected $images;


    public function __construct($parent = null) {

        $this->images = array();

        $this->parent = $parent;

    }


    public static function make($parent = null) {
        return new static($parent);
    }


    public function load($ss) {

    }

    public function filter() {

    }


    public function all() {
        return $this->images;
    }

    public function count() {

    }

    public function add($image) {

    }

    public function remove($image) {

    }


}


class Image_List {

    public $total       = 0;
    public $idList      = array();
    public $data        = array();

}
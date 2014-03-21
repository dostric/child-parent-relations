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

        // if we need finding various images - example image gallery
        return $this;

    }


    public function load($ss = null) {

        if ($ss) {

            //1. we can load by ss

        } else {

            //2. we can load by parent type

            switch(get_class($this->parent)) {
                case 'Object':
                    break;
            }

        }

        $images = array();
        foreach($images as $i) {
            $this->add($i);
        }

        return $this;

    }


    public function getList() {

    }


}


class Image_List extends SearchResultBase {

}
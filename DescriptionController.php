<?php


class DescriptionController implements ControllerInterface {


    protected $parent;

    protected $referenceType;

    protected $referenceId;



    /**
     * Array of description items.
     *
     * @var DescriptionItem[]
     */
    protected $items;


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


    public function load($ss) {

    }


    // filter the descriptions based on provided data.
    public function filter() {

    }


    public function count() {
        return count($this->items);
    }


    public function add($item) {

    }


    public function remove($id) {

    }


    /**
     * @return DescriptionItem[]
     */
    public function all() {
        return $this->items;
    }


    public function has($description) {
        return true;
    }


    public function get($description, $default = null) {
        return $this->has($description) ? $this->items[$description] : $default;
    }

}








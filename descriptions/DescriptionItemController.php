<?php



class DescriptionItemController extends CollectionBase implements ControllerSearchableInterface {


    /**
     * @var DescriptionFrom
     */
    protected $parent;


    /**
     * @var DescriptionItem_Model[]
     */
    protected $items;



    public function __construct($parent = null) {

        $this->values = array();

        $this->parent = $parent;

    }


    public static function make($parent = null) {
        return new static($parent);
    }


    public function model($key = null) {

    }


    public function getId() {

    }


    public function find($ss = null) {


    }


    public function load($ss = null) {

        $formId = null;

        if ($ss) {

            if (is_object($ss)) {

                //TODO - define better the settings
                $formId = $ss->formId;

            } elseif (is_numeric((int)$ss) && $ss > 0) {

                $formId = (int)$ss;

            }


        } elseif ($this->parent) {

            $formId = $this->parent->getId();

        }

        if ($formId) {

            // load the items form the source
            $items = [];

            // obtain the id list of description items
            $itemsIds = [];

            // load all item values from the source
            $values = [];

            foreach($items as $k => $item) {

                $itemValues = $values[$item->id]; // get all the

            }

        }

        return $this;

    }


    public function getList() {

    }

}

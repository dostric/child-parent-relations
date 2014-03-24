<?php


/**
 * Class DescriptionItemController
 *
 * @method DescriptionItem get($id, $default = null)
 * @method DescriptionItem[] all()
 *
 */
class DescriptionItemController extends CollectionBase implements ControllerSearchableInterface {


    /**
     * @var DescriptionFrom
     */
    protected $parent;


    /**
     * @param mixed|null $parent
     * @param DescriptionItem[]|null $items
     */
    public function __construct($parent = null, $items = null) {

        $this->values = array();

        $this->parent = $parent;

        if ($items) {
            parent::__construct($items);
        }

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
            // loading is optimized; we are loading all items and all values;

            /**
             * @var DescriptionItem_Model[]
             */
            $items = [];

            // obtain the id list of description items
            $itemsIds = [];

            // load all item values from the source
            $values = [
                1 => [/* array of description values */],
                2 => [/* array of description values */],
                3 => [/* array of description values */]
            ];

            foreach($items as $k => $item) {

                // we`ll push items by entity
                $this->push(
                    $item->entity,
                    DescriptionItem::make($this, $item, $values[$item->id])
                );

            }

        }

        return $this;

    }


    public function getList() {

    }


}

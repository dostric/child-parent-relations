<?php


/**
 * Class defines what to load during the accommodation load proces.
 * Usually we have multiple entities to load like (units, images, availability, comments, descriptions, ...).
 * We do not want to load all of them at the same time - this is the load confinguration class.
 *
 * @property $object;
 * @property $objectImages;
 *
 * @property $units;
 * @property $unitImages;
 *
 * @property $priceList;
 *
 * @property $availability;
 *
 */
class LoadSettings {

    public function __construct($data = array()) {

        /*
         * parse the input data and set up properties.
         *
         */

    }

    public static function make($data = array()) {
        return new static($data);
    }

}



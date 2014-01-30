<?php


interface ControllerInterface {



    public static function make($parent);

    public function load($ss);

    public function all();

    public function count();

    public function filter();

    public function add($item);

    public function remove($id);


}



class tObjectController extends Collection {


    public function __construct() {
        parent::__construct();

    }

    public function filter() {
        return array();
    }


}



$A = array();

$o = new tObjectController();

// collection of units vs UnitController
$o->all();




$objectOne = $o[1];

foreach($o as $objectId => $object) {

    // get the unit controller
    $unitCnt = $object->units();

    foreach($unitCnt as $unitId => $unit) {

        $unitCnt->updateAllImages();

        foreach($unit->images() as $imageId => $image) {

        }

    }

}

$availItems = $o->filter(function($item) use ($A) {

    if ($item->dateFrom) {
        return false;
    }

    return true;

});


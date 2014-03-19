<?php

$ss = new SearchSettings(array(

'id' => 100

));

$ls = new LoadSettings(array(

    'object'    => true,
    'units'     => true

));


// load the object by id
$object = Object::make(1, $ls);

// get all object units
$units = $object->units()->all();

// get one unit by id
$unit = $object->units()->get(1);



// DESCRIPTIONS
// get object descriptions
$desc = $object->descriptions()->all();

// does the object have a pool description
$hasPool = $object->descriptions()->has('pool');

// get the pool description, if we do not have it return an empty array
$descPool = $object->descriptions()->get('pool', array());



// PRICE LIST
// object price list
$priceList = $object->priceList();

// all object price list items
$priceList = $object->priceList()->all();

// unit price list items
$unitPrices = $object->units()->get(100)->getPriceList();

// custom price list filtering
$customPriceList = $object->priceList()->filter(function ($item) {});



// AVAILABILITY
// all object availability periods
$availability = $object->availability()->all();




// find the objects matching the search, load the data provided by load settings
$oCnt = ObjectCollection::make($ss, $ls)
->find()
->load();

// get the objects
$objects = $oCnt->all();

// get one object
$object = $oCnt->get(100);

// how many objects did we found - if we are using pagination this is the total object count
$total = $oCnt->getList()->total;
$ids = $oCnt->getList()->idList;



// custom finder
// base setup, search and load settings are optional
$oCnt = ObjectCollection::make($ss, $ls);

// do something, check something, setup something

// we`ll find by new data
$oCnt->find($ss);

// do something, check something, setup something

// we`ll load children by new settings
$oCnt->load($ls);


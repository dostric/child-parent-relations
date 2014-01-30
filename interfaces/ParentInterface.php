<?php


interface ParentInterface {


    public static function make();

    public function load();

    public function isLoaded();

    public function get($id, $default = null);

    public function all();

    public function filter();


}
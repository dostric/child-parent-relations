<?php


interface ParentControllerInterface {


    public static function make();

    public function find($ss);

    public function load($ls);

    public function getList();

    public function all();

    public function has($id);

    public function get($id);

    public function count();

    public function add($item);

    public function remove($id);

}
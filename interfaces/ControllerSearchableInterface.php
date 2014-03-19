<?php


interface ControllerSearchableInterface {


    public function count();

    public function all();

    public function has($id);

    public function get($id, $default = null);

    public function add($item);

    public function push($item);

    public function put($key, $item);

    public function forget($id);

    public function filter(Closure $callback);



    public function find($ss);

    public function load($ls);

    public function getList();


}


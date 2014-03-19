<?php


interface ControllerInterface {


    public function load($ss, $ls);

    public function getId();

    public function model($key = null);

}


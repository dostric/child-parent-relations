<?php


interface ControllerInterface {


    public function load($ss);

    public function getId();

    public function model($key = null);

}


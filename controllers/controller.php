<?php
  class Controller{
    public $helper;
    public function __construct(){
      $this->helper = new Helper();
    }
  }

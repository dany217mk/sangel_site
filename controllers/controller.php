<?php
  class Controller{
    public $helper;
    private  $isAuth = false;
    private  $adminModel;
    public $admin;
    public function __construct(){
      $this->helper = new Helper();
      $this->adminModel = new Admin();
      $this->isAuth = $this->adminModel->isAuth();
    if ($this->isAuth) {
        $this->admin = $this->adminModel->getAdmin();
        $this->helper = new Helper();
    }
  }

  public function getIsAuth(){
    return $this->isAuth;
  }
  public function getAdminModel(){
    return $this->adminModel;
  }
  public function getAdmin(){
    return $this->admin;
  }
  }
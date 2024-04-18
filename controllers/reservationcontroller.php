<?php

class ReservationController extends Controller
{
  public function __construct(){
    parent::__construct();
  }
  public function actionIndex(){
    $title = 'Предзаказы';
    $styles = [CSS . '/reservations.css'];
    require_once   './views/admin/common/head.html';
    require_once   './views/admin/common/header.html';
    require_once   './views/admin/common/nav.html';
    require_once  './views/admin/reservations.html';
    require_once   './views/admin/common/footer.html';
    require_once   './views/admin/common/foot.html';
    }
}
<?php

class ReservationController extends Controller
{
  public function __construct(){
    parent::__construct();
    $this->reservationModel = new Reservation();
  }
  public function actionIndex(){
    $title = 'Предзаказы';
    $styles = [CSS . '/reservations.css'];
    $data = $this->reservationModel->getAll();
    $headers = array(
        'ID', 'ФИО', 'Email', 'Наименование продукта', 'Обработано',
    );
    $type = "reservation";
    require_once   './views/admin/common/head.html';
    require_once   './views/admin/common/header.html';
    require_once   './views/admin/common/nav.html';
    require_once  './views/admin/reservations.php';
    require_once   './views/admin/common/footer.html';
    require_once   './views/admin/common/foot.html';
    }
    public function actionDelete($data){
      if (!$this->getIsAuth()) {
        exit("Error");
      }
      $id = $data[0];
      $this->reservationModel->delete($id);
      header("Location: " . FULL_SITE_ROOT . "/reservations");
    }

    public function actionEdit($data){
      if (!$this->getIsAuth()) {
        exit("Error");
      }
      $id = $data[0];
      $this->reservationModel->edit($id);
      header("Location: " . FULL_SITE_ROOT . "/reservations");
    }
}

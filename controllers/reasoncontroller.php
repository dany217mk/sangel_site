<?php

class ReasonController extends Controller
{
  public function __construct(){
    parent::__construct();
    $this->reasonModel = new Reason();
  }
  public function actionIndex(){
    $title = 'Причины обращения';
    $styles = [CSS . '/reasons.css'];
    $data = $this->reasonModel->getAll();
    $headers = array(
        'ID', 'Причина обращения'
    );
    $type = "reason";
    require_once   './views/admin/common/head.html';
    require_once   './views/admin/common/header.html';
    require_once   './views/admin/common/nav.html';
    require_once  './views/admin/reasons.php';
    require_once   './views/admin/common/footer.html';
    require_once   './views/admin/common/foot.html';
    }

    public function actionDelete($data){
      if (!$this->getIsAuth()) {
        exit("Error");
      }
      $id = $data[0];
      $this->reasonModel->delete($id);
      header("Location: " . FULL_SITE_ROOT . "/reasons");
    }

    public function actionAdd(){
      if (!$this->getIsAuth()) {
        exit("Error");
      }
      if (isset($_POST['reason_name'])){
        $name = $_POST['reason_name'];
        $this->reasonModel->add($name);
        header("Location: " . FULL_SITE_ROOT . "/reasons");
      }
      $title = 'Добавление причины обращения';
      $styles = [CSS . '/admin_form.css', CSS . '/admin_all.css'];
      require_once   './views/admin/common/head.html';
      require_once   './views/admin/common/header.html';
      require_once   './views/admin/common/nav.html';
      require_once  './views/admin/reason_form.html';
      require_once   './views/admin/common/footer.html';
      require_once   './views/admin/common/foot.html';
    }

    public function actionEdit($data){
      if (!$this->getIsAuth()) {
        exit("Error");
      }
      $id = $data[0];
      $reason = $this->reasonModel->getById($id);
      if (isset($_POST['reason_name'])){
        $name = $_POST['reason_name'];
        $this->reasonModel->edit($name, $id);
        header("Location: " . FULL_SITE_ROOT . "/reasons");
      }
      $title = 'Добавление причины обращения';
      $styles = [CSS . '/admin_form.css', CSS . '/admin_all.css'];
      require_once   './views/admin/common/head.html';
      require_once   './views/admin/common/header.html';
      require_once   './views/admin/common/nav.html';
      require_once  './views/admin/reason_form.html';
      require_once   './views/admin/common/footer.html';
      require_once   './views/admin/common/foot.html';
    }
}

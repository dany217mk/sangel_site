<?php

class FeedbackController extends Controller
{
  private $feedbackModel;
  public function __construct(){
    parent::__construct();
    $this->feedbackModel = new Feedback();
  }
  public function actionIndex(){
    $title = 'Обратная связь';
    $styles = [CSS . '/admin_table.css'];
    $data = $this->feedbackModel->getAll();
    $headers = array(
        'ID', 'ФИО', 'Email', 'Text', 'Причина обращения', 'Оценка (отзыв)', 'Обработано',
    );
    $type = "feedback";
    require_once   './views/admin/common/head.html';
    require_once   './views/admin/common/header.html';
    require_once   './views/admin/common/nav.html';
    require_once  './views/admin/feedback.php';
    require_once   './views/admin/common/footer.html';
    require_once   './views/admin/common/foot.html';
    }

    public function actionDelete($data){
      if (!$this->getIsAuth()) {
        exit("Error");
      }
      $id = $data[0];
      $this->feedbackModel->delete($id);
      header("Location: " . FULL_SITE_ROOT . "/admin_feedback");
    }

    public function actionEdit($data){
      if (!$this->getIsAuth()) {
        exit("Error");
      }
      $id = $data[0];
      $this->feedbackModel->edit($id);
      header("Location: " . FULL_SITE_ROOT . "/admin_feedback");
    }
}

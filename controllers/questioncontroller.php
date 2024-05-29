<?php

class QuestionController extends Controller
{
  public function __construct(){
    parent::__construct();
    $this->questionModel = new Question();
  }
  public function actionIndex(){
    $title = 'FAQ';
    $styles = [CSS . '/questions.css'];
    $data = $this->questionModel->getAll();
    $headers = array(
        'ID', 'Текст вопроса', 'Ответ'
    );
    $type = "question";
    require_once   './views/admin/common/head.html';
    require_once   './views/admin/common/header.html';
    require_once   './views/admin/common/nav.html';
    require_once  './views/admin/questions.php';
    require_once   './views/admin/common/footer.html';
    require_once   './views/admin/common/foot.html';
    }

    public function actionDelete($data){
      if (!$this->getIsAuth()) {
        exit("Error");
      }
      $id = $data[0];
      $this->questionModel->delete($id);
      header("Location: " . FULL_SITE_ROOT . "/admin_questions");
    }

    public function actionAdd(){
      if (!$this->getIsAuth()) {
        exit("Error");
      }
      if (isset($_POST['question_text'])){
        $text = $_POST['question_text'];
        $answer = $_POST['question_answer'];
        $this->questionModel->add($text, $answer);
        header("Location: " . FULL_SITE_ROOT . "/admin_questions");
      }
      $title = 'Добавление вопроса';
      $styles = [CSS . '/admin_form.css', CSS . '/admin_all.css'];
      require_once   './views/admin/common/head.html';
      require_once   './views/admin/common/header.html';
      require_once   './views/admin/common/nav.html';
      require_once  './views/admin/question_form.html';
      require_once   './views/admin/common/footer.html';
      require_once   './views/admin/common/foot.html';
    }

    public function actionEdit($data){
      if (!$this->getIsAuth()) {
        exit("Error");
      }
      $id = $data[0];
      $question = $this->questionModel->getById($id);
      if (isset($_POST['question_text'])){
        $text = $_POST['question_text'];
        $answer = $_POST['question_answer'];
        $this->questionModel->edit($text, $answer, $id);
        header("Location: " . FULL_SITE_ROOT . "/admin_questions");
      }
      $title = 'Добавление вопроса';
      $styles = [CSS . '/admin_form.css', CSS . '/admin_all.css'];
      require_once   './views/admin/common/head.html';
      require_once   './views/admin/common/header.html';
      require_once   './views/admin/common/nav.html';
      require_once  './views/admin/question_form.html';
      require_once   './views/admin/common/footer.html';
      require_once   './views/admin/common/foot.html';
    }
}

<?php
class MainController extends Controller
{
  public function __construct(){
    parent::__construct();
  }
  public function actionIndex(){
    if ($_SERVER['REQUEST_URI'] != REQUEST_URI_EXIST) {
      header("Location: " . FULL_SITE_ROOT . "/report/noexist");
      die();
    }

    if (isset($_POST['form_products'])) {
      $fio = $this->helper->escape_srting($_POST['fio']);
      $email = $this->helper->escape_srting($_POST['email']);
      $form_products = $this->helper->escape_srting($_POST['form_products']);
      $reservationModel = new Reservation();
      $reservationModel->add($fio, $email, $form_products);
      header("Location: " . FULL_SITE_ROOT . "/report/success");
    }

    $productModel = new Product();
    $products = $productModel->getShowAll();
    $products_reservations = $productModel->getShowReservationsAll();
    $styles = [CSS . '/home.css', CSS . '/js-snackbar.css'];
    $scripts = [JS . '/home.js', JS . '/slider.js', JS . '/js-snackbar.js'];
    $title = SERVER_NAME;
    $this->helper->outputCommonHead($title, $styles);
    require_once  './views/home.html';
    $this->helper->outputCommonFoot($scripts);
  }

  public function actionReport($data){
         $incident = $data[0];
         $title = $incident;
         $styles = [CSS . '/report.css'];
         $this->helper->outputCommonHead($title, $styles);
         require_once  './views/report.html';
         $this->helper->outputCommonFoot();
  }
  public function actionPrivacy(){
    $title = 'Политика сайта';
    $styles = [CSS . '/privacy.css'];
    $scripts = [JS . '/privacy.js'];
    $this->helper->outputCommonHead($title, $styles);
    require_once  './views/privacy.html';
    $this->helper->outputCommonFoot($scripts);
  }

  public function actionQuestions(){
    $title = 'FAQ';
    $styles = [CSS . '/faq.css'];
    $scripts = [JS . '/faq.js'];
    $questionModel = new Question();
    $questions = $questionModel->getShowAll();
    $this->helper->outputCommonHead($title, $styles);
    require_once  './views/faq.html';
    $this->helper->outputCommonFoot($scripts);
  }

  public function actionContact(){
    if (isset($_POST['fio'])) {
      $fio = $this->helper->escape_srting($_POST['fio']);
      $email = $this->helper->escape_srting($_POST['email']);
      $reason = $this->helper->escape_srting($_POST['reason']);
      $text = $this->helper->escape_srting($_POST['text']);
      if (isset($_POST['rating']) && $reason == 2) {
        $rating = $this->helper->escape_srting($_POST['rating']);
      } else{
        $rating = -1;
      }
      $feedbackModel = new Feedback();
      $feedbackModel->add($fio, $email, $reason, $text, $rating);
      header("Location: " . FULL_SITE_ROOT . "/report/success");
    }
    $title = "Обратная связь";
    $reasonModel = new Reason();
    $reasons = $reasonModel->getShowAll();
    $styles = [CSS . '/contact.css'];
    $scripts = [JS . '/contact.js'];
    $this->helper->outputCommonHead($title, $styles);
    require_once  './views/contact.html';
    $this->helper->outputCommonFoot($scripts);
  }


}

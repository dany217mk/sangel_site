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
    $productModel = new Product();
    $products = $productModel->getShowAll();
    $products_reservations = $productModel->getShowReservationsAll();
    $styles = [CSS . '/home.css'];
    $scripts = [JS . '/home.js', JS . '/slider.js'];
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

  public function actionContact(){
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

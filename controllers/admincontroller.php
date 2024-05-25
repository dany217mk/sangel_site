<?php

class AdminController extends Controller
{
  public function __construct(){
    parent::__construct();
    $this->adminModel = new Admin();
  }
  public function actionAuth(){

      if ($this->adminModel->isAuth()){
        header("Location: admin_feedback");
      }
      $errors = [];
      if (isset($_POST['login'])) {
        $login = $this->helper->escape_srting($_POST['login']);
        $password = $this->helper->escape_srting($_POST['password']);
        $hash_password = md5($password);
        $uid = $this->adminModel->checkIfAdminExistAuth($login, $hash_password);
        if($uid != -1){
            if ($uid == 0) {
              $errors['login'] = "Неверный логин или пароль!";
            } else {
                $this->adminModel->setAuth($uid);
                header('location: admin_feedback');
          }
      } else{
            $errors['login'] = "Администратора с таким логином не существует";
        }
    }
      $title = "Admin panel";
      $style_path = [CSS . '/auth.css'];
      require_once   './views/admin/auth.html';
    }



    public function actionViews(){
      if (!$this->getIsAuth()) {
        exit("Error");
      }
      $title = 'Администраторы';
      $data = $this->adminModel->getAll();
      $styles = [];
      $headers = array(
          'ID', 'Имя', 'login', 'Уровень доступа',
      );
      $type = "admin";
      require_once   './views/admin/common/head.html';
      require_once   './views/admin/common/header.html';
      require_once   './views/admin/common/nav.html';
      require_once  './views/admin/admins.php';
      require_once   './views/admin/common/footer.html';
      require_once   './views/admin/common/foot.html';
      }



    public function actionLogout(){
        $this->adminModel->logout();
      }
}

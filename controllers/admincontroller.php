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


      public function actionAdd(){
        if (!$this->getIsAuth() and $this->getAdmin()['admin_level'] != 1) {
          exit("Error");
        }
        $errors = [];
        if (isset($_POST['login'])){
          $name = $this->helper->escape_srting($_POST['name']);
          $login = $this->helper->escape_srting($_POST['login']);
          $level = $this->helper->escape_srting($_POST['level']);
          $password = $this->helper->escape_srting($_POST['password']);
          $cpassword = $_POST['cpassword'];
          if($password !== $cpassword){
            $errors['password'] = "Пароли не совпадают!";
          }
          $login_check = $this->adminModel->checkIfAdminExistAuth($login);
          if($login_check != -1){
            $errors['email'] = "Логин, который вы ввели, уже существует!";
          }
          if(count($errors) === 0){
            $password = md5($password);
            $this->adminModel->add($name, $login, $password, $level);
            header("Location: " . FULL_SITE_ROOT . "/admins");
          }
        }
          $title = 'Добавление администратора';
          $styles = [CSS . '/reg.css'];
          require_once  './views/admin/reg.html';
          }

          public function actionDelete($data){
            if (!$this->getIsAuth()) {
              exit("Error");
            }
            $id = $data[0];
            $this->adminModel->delete($id);
            header("Location: " . FULL_SITE_ROOT . "/admins");
          }



    public function actionLogout(){
        $this->adminModel->logout();
      }
}

<?php
class Helper
{

  private $con;

  public function __construct()
  {
    $this->con = DB::getConnection();
  }


  public function outputCommonHead($title, $styles=[]){
    require_once   './views/common/head.html';
    require_once   './views/common/header.html';
  }

  public function outputCommonFoot($scripts=[]){
    require_once   './views/common/footer.html';
    require_once   './views/common/foot.html';
  }

  public function generationToken($size = 32){
    $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $token = "";
    for ($i=0; $i<$size; $i++) {
      $rnd = rand(0, strlen($chars)-1);
      $token .= substr($chars, $rnd, 1);
    }
    return $token;
  }

  public function escape_srting($val){
    return htmlentities(mysqli_real_escape_string($this->con, $val));
  }

  public function checkImg($val)
        {
          $bool = true;
          $allowed = array('gif', 'png', 'jpeg', 'jpg');
          $filename = $_FILES[$val]['name'];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          if (!in_array($ext, $allowed)) {
            header("Location: " . FULL_SITE_ROOT . "/report/errorImg");
            die;
            $bool = false;
          } else {
            if ($_FILES[$val]['size'] > 10000000){
              header("Location: " . FULL_SITE_ROOT . "/report/errorImg");
              die;
              $bool = false;
            }
          }
          return $bool;
        }



}

<?php

class ProductController extends Controller
{
  private $productModel;
  public function __construct(){
    parent::__construct();
    $this->productModel = new Product();
  }

  public function actionIndex(){
    $title = 'Продукты';
    $data = $this->productModel->getAll();
    $styles = [CSS . '/admin_table.css'];
    $headers = array(
        'ID', 'Наименование', 'Описание', 'Фото', 'Открыт ли предзаказ на товар?', 'Цена товара', 'Показывать ли продукт на главной странице'
    );
    $type = "product";
    require_once   './views/admin/common/head.html';
    require_once   './views/admin/common/header.html';
    require_once   './views/admin/common/nav.html';
    require_once  './views/admin/products.php';
    require_once   './views/admin/common/footer.html';
    require_once   './views/admin/common/foot.html';
    }

    public function actionDelete($data){
      if (!$this->getIsAuth()) {
        exit("Error");
      }
      $id = $data[0];
      $product = $this->productModel->getById($id);
      unlink("./assets/img_product/" . $product['product_img']);
      $this->productModel->delete($id);
      header("Location: " . FULL_SITE_ROOT . "/products");
    }

    public function actionAdd(){
      if (!$this->getIsAuth()) {
        exit("Error");
      }

      if (isset($_POST['product_name'])){
        if ($_FILES['product_img']['error'] != 0) {
          $filename = "";
        } else{
          $file = 'product_img';
          $upload_path = './assets/img_product';
          if (!is_dir($upload_path)){
              header("Location: " . FULL_SITE_ROOT . "/report/connectAdmin");
              exit;
          }
            $bool = $this->helper->checkImg($file);
            if (!$bool) {
                header("Location: " . FULL_SITE_ROOT . "/report/connectAdmin");
                die;
              }

                $filename = md5(pathinfo($_FILES[$file]['name'], PATHINFO_FILENAME)) . '.' . pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);

                  $allow = false;
                  $counterIter = 0;

                  while (!$allow) {
                  $counterIter++;
                  $row = $this->productModel->get_product_imgs_filenames($filename);
                  $counter = $row['COUNT(*)'];
                  if ($counter > 0) {
                    $allow = false;
                  } else {
                    $allow = true;
                  }
                if (!$allow){
                  $filename = md5(pathinfo($_FILES[$file]['name'], PATHINFO_FILENAME)) . '(' . $counterIter . ').' . pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
                }
              }

              move_uploaded_file($_FILES[$file]['tmp_name'], $upload_path . '/' . $filename);
            }
        $name = $_POST['product_name'];
        $desc = $_POST['product_description'];
        $access = $_POST['product_reservetion_access'];
        $price = $_POST['product_price'];
        $show = $_POST['product_show'];
        $this->productModel->add($name, $desc, $access, $price, $show, $filename);
        header("Location: " . FULL_SITE_ROOT . "/products");
      }
        $title = 'Добавление продукта';
        $styles = [CSS . '/admin_form.css', CSS . '/admin_all.css'];
        require_once   './views/admin/common/head.html';
        require_once   './views/admin/common/header.html';
        require_once   './views/admin/common/nav.html';
        require_once  './views/admin/product_form.html';
        require_once   './views/admin/common/footer.html';
        require_once   './views/admin/common/foot.html';
        }

        public function  actionEdit($data){
             if (!$this->getIsAuth()) {
               exit("Error");
             }
             $errors = [];
             $id = $data[0];
             $product = $this->productModel->getById($id);
             if (isset($_POST['product_name'])) {
               if (empty($errors)) {
                 if ($_FILES['product_img']['error'] != 0) {
                   if ($product["product_img"] == ""){
                     $filename = "";
                   } else {
                     $filename = $product["product_img"];
                   }
                 } else{
                   unlink("./assets/img_product/" . $product['product_img']);
                   $this->productModel->deleteImg($id);
                   $file = 'product_img';
                   $upload_path = './assets/img_product';
                   if (!is_dir($upload_path)){
                       header("Location: " . FULL_SITE_ROOT . "/report/connectAdmin");
                       exit;
                   }
                   $bool = $this->helper->checkImg($file);
                     if (!$bool) {
                         header("Location: " . FULL_SITE_ROOT . "/report/connectAdmin");
                         exit;
                       }

                         $filename = md5(pathinfo($_FILES[$file]['name'], PATHINFO_FILENAME)) . '.' . pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);

                           $allow = false;
                           $counterIter = 0;

                           while (!$allow) {
                           $counterIter++;
                           $row = $this->productModel->get_product_imgs_filenames($filename);
                           $counter = $row['COUNT(*)'];
                           if ($counter > 0) {
                             $allow = false;
                           } else {
                             $allow = true;
                           }
                         if (!$allow){
                           $filename = md5(pathinfo($_FILES[$file]['name'], PATHINFO_FILENAME)) . '(' . $counterIter . ').' . pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
                         }
                       }

                       move_uploaded_file($_FILES[$file]['tmp_name'], $upload_path . '/' . $filename);
                     }



                 $name = $_POST['product_name'];
                 $desc = $_POST['product_description'];
                 $access = $_POST['product_reservetion_access'];
                 $price = $_POST['product_price'];
                 $show = $_POST['product_show'];
                 $this->productModel->update($name, $desc, $access, $price, $show, $filename, $id);
                 header("Location: " . FULL_SITE_ROOT . "/products");
               }
             }
             $title = 'Редактирование продукта';
             $styles = [CSS . '/admin_form.css', CSS . '/admin_all.css'];
             require_once   './views/admin/common/head.html';
             require_once   './views/admin/common/header.html';
             require_once   './views/admin/common/nav.html';
             require_once  './views/admin/product_form.html';
             require_once   './views/admin/common/footer.html';
             require_once   './views/admin/common/foot.html';
         }

}

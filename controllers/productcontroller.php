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
    $styles = [];
    $headers = array(
        'ID', 'Наименование', 'Описание', 'Открыт ли предзаказ на товар?', 'Цена товара',
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
      $this->productModel->delete($id);
      header("Location: " . FULL_SITE_ROOT . "/products");
    }

    public function actionAdd(){
      if (!$this->getIsAuth()) {
        exit("Error");
      }
            if (isset($_POST['product_name'])){
                $name = $_POST['product_name'];
                $desc = $_POST['product_description'];
                $access = $_POST['product_reservetion_access'];
                $price = $_POST['product_price'];
                $this->productModel->add($name, $desc, $access, $price);
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
                 $name = $_POST['product_name'];
                 $desc = $_POST['product_description'];
                 $access = $_POST['product_reservetion_access'];
                 $price = $_POST['product_price'];
                 $this->productModel->update($name, $desc, $access, $price, $id);
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

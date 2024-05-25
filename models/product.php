<?php
class Product extends Model{
  public function getAll()
    {
        $query = "SELECT * FROM `products`;";
        return parent::returnAllNum($query);
    }

    public function add($name, $desc, $access, $price, $filename)
    {
        $query = "INSERT INTO `products` (`product_name`, `product_description`, `product_reservetion_access`, `product_price`, `product_img`) VALUES ('$name', '$desc', '$access', '$price', '$filename');";
        parent::actionQuery($query);
    }

    public function getById($id){
        $query = "SELECT * FROM `products` WHERE `product_id` = $id";
        $res = parent::returnActionQuery($query);
        return mysqli_fetch_assoc($res);
    }

    public function deleteImg($id){
      $query = "
          UPDATE `products` SET `product_img` = '' WHERE `product_id` = $id;
      ";
      parent::actionQuery($query);
    }

    public function update($name, $desc, $access, $price, $filename, $id)
    {
        $query = "UPDATE `products` SET `product_name` = '$name', `product_description` = '$desc', `product_reservetion_access` = '$access', `product_price` = '$price', `product_img` = '$filename'  WHERE `product_id` = $id;";
        parent::actionQuery($query);
    }

    public function get_product_imgs_filenames($filename){
      $query = "SELECT COUNT(*) FROM `products` WHERE `product_img` = '" . $filename . "'";
      $res = parent::returnActionQuery($query);
      return mysqli_fetch_assoc($res);
    }


    public function delete($id){
      $query = "
          DELETE FROM `products` WHERE `product_id` = $id;
      ";
      parent::actionQuery($query);
    }
}

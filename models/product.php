<?php
class Product extends Model{
  public function getAll()
    {
        $query = "SELECT * FROM `products`;";
        return parent::returnAllNum($query);
    }

    public function add($name, $desc, $access, $price)
    {
        $query = "INSERT INTO `products` (`product_name`, `product_description`, `product_reservetion_access`, `product_price`) VALUES ('$name', '$desc', '$access', '$price');";
        parent::actionQuery($query);
    }

    public function getById($id){
        $query = "SELECT * FROM `products` WHERE `product_id` = $id";
        $res = parent::returnActionQuery($query);
        return mysqli_fetch_assoc($res);
    }

    public function update($name, $desc, $access, $price, $id)
    {
        $query = "UPDATE `products` SET `product_name` = '$name', `product_description` = '$desc', `product_reservetion_access` = '$access', `product_price` = '$price'  WHERE `product_id` = $id;";
        parent::actionQuery($query);
    }


    public function delete($id){
      $query = "
          DELETE FROM `products` WHERE `product_id` = $id;
      ";
      parent::actionQuery($query);
    }
}

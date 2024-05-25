<?php
class Reservation extends Model {
public function getAll()
{
  $query = "SELECT `reservation_id`, `reservation_fio`, `reservation_email`, `product_name`, `admin_name`
            FROM `reservations`
            LEFT JOIN `products` ON `reservation_product_id` = `product_id`
            LEFT JOIN `statuses` ON `reservation_id` = `status_reservation_id`
            LEFT JOIN `admins` ON `status_admin_id` = `admin_id`
            GROUP BY  `reservation_id`;";
    return parent::returnAllNum($query);
}
public function delete($id){
    $query = "
        DELETE FROM `reservations` WHERE `reservation_id` = $id;
    ";
    $query2 = "
      DELETE FROM `statuses` WHERE `status_reservation_id` = $id;
    ";
    parent::actionQuery($query2);
    parent::actionQuery($query);
  }
  public function edit($id){
    $query = "
    INSERT INTO `statuses` (`status_admin_id`, `status_reservation_id`) VALUES ('" . $_COOKIE['uid'] . "', '$id');;
    ";
    parent::actionQuery($query);
  }
}

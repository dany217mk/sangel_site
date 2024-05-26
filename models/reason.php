<?php
class Reason extends Model {
public function getAll()
{
  $query = "SELECT `reason_id`, `reason_name` FROM `reasons`;";
    return parent::returnAllNum($query);
}
public function getShowAll()
{
  $query = "SELECT `reason_id`, `reason_name` FROM `reasons`;";
    return parent::returnAllAssoc($query);
}
public function add($name)
{
    $query = "INSERT INTO `reasons` (`reason_name`) VALUES ('$name');";
    parent::actionQuery($query);
}
public function delete($id){
    $query = "
        DELETE FROM `reasons` WHERE `reason_id` = $id;
    ";
    parent::actionQuery($query);
  }
  public function edit($name, $id){
    $query = "UPDATE `reasons` SET `reason_name` = '$name' WHERE `reason_id` = $id;";
    parent::actionQuery($query);
  }
  public function getById($id){
      $query = "SELECT * FROM `reasons` WHERE `reason_id` = $id";
      $res = parent::returnActionQuery($query);
      return mysqli_fetch_assoc($res);
  }

}

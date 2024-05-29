<?php
class Feedback extends Model {
public function getAll()
{
  $query = "SELECT `feedback_id`, `feedback_fio`, `feedback_email`, `feedback_text`,`reason_name`,  `feedback_mark`, `admin_name`
            FROM `feedback`
            LEFT JOIN `reasons` ON `feedback_reason_id` = `reason_id`
            LEFT JOIN `readit` ON `feedback_id` = `readit_feedback_id`
            LEFT JOIN `admins` ON `readit_admin_id` = `admin_id`
            GROUP BY  `feedback_id`;";
    return parent::returnAllNum($query);
}
public function add($fio, $email, $reason, $text, $rating){
  if ($rating != -1) {
    $query = "INSERT INTO `feedback` (`feedback_fio`, `feedback_email`, `feedback_reason_id`, `feedback_text`, `feedback_mark`) VALUES ('$fio', '$email', '$reason', '$text', '$rating');";
  } else {
    $query = "INSERT INTO `feedback` (`feedback_fio`, `feedback_email`, `feedback_reason_id`, `feedback_text`, `feedback_mark`) VALUES ('$fio', '$email', '$reason', '$text', NULL);";
  }

  parent::actionQuery($query);
}
public function delete($id){
    $query = "
        DELETE FROM `feedback` WHERE `feedback_id` = $id;
    ";
    $query2 = "
      DELETE FROM `readit` WHERE `readit_feedback_id` = $id;
    ";
    parent::actionQuery($query2);
    parent::actionQuery($query);
  }
  public function edit($id){
    $query = "
    INSERT INTO `readit` (`readit_admin_id`, `readit_feedback_id`) VALUES ('" . $_COOKIE['uid'] . "', '$id');;
    ";
    parent::actionQuery($query);
  }
}

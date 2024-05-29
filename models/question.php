<?php
class Question extends Model {
public function getAll()
{
  $query = "SELECT * FROM `questions`;";
    return parent::returnAllNum($query);
}
public function getShowAll()
{
  $query = "SELECT * FROM `questions`;";
    return parent::returnAllAssoc($query);
}
public function add($question, $answer)
{
    $query = "INSERT INTO `questions` (`question_text`, `question_answer`) VALUES ('$question', '$answer');";
    parent::actionQuery($query);
}
public function delete($id){
    $query = "
        DELETE FROM `questions` WHERE `question_id` = $id;
    ";
    parent::actionQuery($query);
  }
  public function edit($question, $answer,  $id){
    $query = "UPDATE `questions` SET `question_text` = '$question', `question_answer` = '$answer' WHERE `question_id` = $id;";
    parent::actionQuery($query);
  }
  public function getById($id){
      $query = "SELECT * FROM `questions` WHERE `question_id` = $id";
      $res = parent::returnActionQuery($query);
      return mysqli_fetch_assoc($res);
  }

}

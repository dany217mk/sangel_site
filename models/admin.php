<?php
 class Admin extends Model{
    public  function isAuth(){
        if (isset($_COOKIE['uid']) && isset($_COOKIE['t']) && isset($_COOKIE['tt'])){
            $timeToken = $_COOKIE['tt'];
            $query = "SELECT * FROM `connects` WHERE `connect_admin_id` = '" . $_COOKIE['uid'] . "' and `connect_token` = '" . $_COOKIE['t'] . "'";
            $res = $this->returnActionQuery($query);
            if (mysqli_num_rows($res) > 0){
                if (time() > $_COOKIE['tt']){
                    $token = $this->getHelper()->generationToken();
                    $timeToken = time() + 1800;
                    $query = "UPDATE `connects` SET `connect_token` = '$token', `connect_time` = FROM_UNIXTIME('$timeToken') WHERE `connect_admin_id` = '" . $_COOKIE['uid']  . "' and `connect_token` = '" . $_COOKIE['t']  . "';";
                    parent::actionQuery($query);
                    setcookie('uid', $_COOKIE['uid'], time() + 2*24*3600, '/');
                    setcookie('t', $token, time() + 2*24*3600, '/');
                    setcookie('tt', $timeToken, time() + 2*24*3600, '/');
                }
                return true;
            } else {
              $this->logout();
            }
        }
        return false;
    }

    public function setAuth($uid){
        $token = $this->getHelper()->generationToken();
        $timeToken = time() + 1800;
        $query = "INSERT INTO `connects` (`connect_admin_id`, `connect_token`, `connect_time`) VALUES ($uid, '$token', FROM_UNIXTIME('$timeToken'))";
        $this->actionQuery($query);
        setcookie('uid', $uid, time() + 2*24*3600, '/');
        setcookie('t', $token, time() + 2*24*3600, '/');
        setcookie('tt', $timeToken, time() + 2*24*3600, '/');
    }

    public function logout(){
        $query = "DELETE FROM `connects` WHERE `connect_admin_id` = '" . $_COOKIE['uid'] . "'";
        $this->actionQuery($query);
        setcookie('uid', '', -1, '/');
        setcookie('t', '', -1, '/');
        setcookie('tt', '', -1, '/');
        header('Location: ' . FULL_SITE_ROOT);
    }

    public function checkIfAdminExistAuth($login, $password){
        $query = "SELECT * FROM `admins` WHERE `admin_login` = '$login';";
        $res = $this->returnActionQuery($query);
        if (mysqli_num_rows($res) == 0){
          return -1;
        }
        $fetch_admin = mysqli_fetch_assoc($res);
        if ($password != $fetch_admin['admin_password']) {
          return 0;
        }
        return $fetch_admin['admin_id'];
      }

      public function getAdmin(){
        $query = "SELECT * FROM `admins`
         WHERE `admin_id` = '" . $_COOKIE['uid'] . "'";
        return $this->returnAssoc($query);
      }

      public function getAll()
        {
            $query = "SELECT `admin_id`, `admin_name`, `admin_login`, `admin_level` FROM `admins`;";
            return parent::returnAllNum($query);
        }

 }

<?php

 require_once "./components/autoload.php";
 require_once "./config/constants.php";



  $status = SITE_STATUS;
  if ($status != "open" && $_SERVER['REQUEST_URI'] != SITE_STATUS_CLOSE) {
    header("Location: " . FULL_SITE_ROOT . "/report/technical");
  }

 $router = new Router;
$router->run();
